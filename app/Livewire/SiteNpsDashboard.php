<?php

namespace App\Livewire;

use App\Models\NpsResponse;
use App\Models\Site;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Url;

class SiteNpsDashboard extends Component
{
    use WithPagination;

    public Collection $sites; // User's sites
    #[Url] // Keep selected site in URL query string
    public ?int $selectedSiteId = null;

    // Metrics (reset when site changes)
    public float $npsScore = 0;
    public float $averageScore = 0;
    public int $totalResponses = 0;
    public int $promotersCount = 0;
    public int $passivesCount = 0;
    public int $detractorsCount = 0;
    public float $promotersPercentage = 0;
    public float $passivesPercentage = 0;
    public float $detractorsPercentage = 0;

    // Feedback Table Filters & Sorting
    #[Url] public string $feedbackSearch = '';
    #[Url] public ?string $feedbackTypeFilter = null; // 'Promoter', 'Passive', 'Detractor'
    #[Url] public string $feedbackSortBy = 'submitted_at';
    #[Url] public string $feedbackSortDirection = 'desc';
    #[Url] public string $dateFilter = 'all_time'; // 'today', 'last_7_days', 'last_30_days', 'last_year', 'all_time'

    public function mount(): void
    {
        $this->sites = Auth::user()->sites()->orderBy('name')->get();

        // Automatically select the first site if only one exists, or none is selected
        if (!$this->selectedSiteId && $this->sites->count() >= 1) {
            $this->selectedSiteId = $this->sites->first()->id;
        }

        $this->calculateMetrics();
    }

    // Recalculate when selectedSiteId changes
    public function updatedSelectedSiteId($value): void
    {
        $this->selectedSiteId = $value ? (int)$value : null;
        $this->resetPage('feedbackPage'); // Reset pagination when site changes
        $this->resetFiltersAndMetrics(); // Reset filters and metrics
        $this->calculateMetrics();
    }

    public function updatingFeedbackSearch(): void
    {
        $this->resetPage('feedbackPage');
    }
    public function updatingFeedbackTypeFilter(): void
    {
        $this->resetPage('feedbackPage');
    }

    // Add hook for date filter changes
    public function updatedDateFilter(): void
    {
        $this->resetPage('feedbackPage');
        $this->calculateMetrics(); // Recalculate metrics based on new date range
    }

    public function resetFiltersAndMetrics(): void
    {
        $this->reset('feedbackSearch', 'feedbackTypeFilter', 'feedbackSortBy', 'feedbackSortDirection');
        $this->dateFilter = 'all_time'; // Explicitly reset to default
        $this->reset('npsScore', 'averageScore', 'totalResponses', 'promotersCount', 'passivesCount', 'detractorsCount', 'promotersPercentage', 'passivesPercentage', 'detractorsPercentage');
    }

    // Helper method to apply date filter to query
    private function applyDateFilter($query)
    {
        return match ($this->dateFilter) {
            'today' => $query->whereDate('submitted_at', Carbon::today()),
            'last_7_days' => $query->whereBetween('submitted_at', [Carbon::today()->subDays(6), Carbon::now()]), // Include today
            'last_30_days' => $query->whereBetween('submitted_at', [Carbon::today()->subDays(29), Carbon::now()]), // Include today
            'last_year' => $query->whereBetween('submitted_at', [Carbon::today()->subYear()->startOfYear(), Carbon::today()->subYear()->endOfYear()]),
            'all_time' => $query, // No date filter
            default => $query, // Default to no filter if value is unexpected
        };
    }

    public function calculateMetrics(): void
    {
        if (!$this->selectedSiteId) {
            $this->resetFiltersAndMetrics();
            return; // No site selected
        }

        // Base query
        $baseQuery = NpsResponse::where('site_id', $this->selectedSiteId);

        // Apply date filter
        $filteredQuery = $this->applyDateFilter(clone $baseQuery); // Clone to avoid modifying base query for later use if needed

        // Get scores for the filtered period
        $responseScores = $filteredQuery->select('score')->get();

        $this->totalResponses = $responseScores->count();

        if ($this->totalResponses === 0) {
            $this->reset('npsScore', 'averageScore', 'promotersCount', 'passivesCount', 'detractorsCount', 'promotersPercentage', 'passivesPercentage', 'detractorsPercentage');
            return; // Avoid division by zero
        }

        $this->averageScore = round($responseScores->avg('score'), 2);

        $this->promotersCount = $responseScores->where('score', '>=', 9)->count();
        $this->passivesCount = $responseScores->whereBetween('score', [7, 8])->count();
        $this->detractorsCount = $responseScores->where('score', '<=', 6)->count(); // Adjusted to <= 6

        $this->promotersPercentage = round(($this->promotersCount / $this->totalResponses) * 100, 1);
        $this->passivesPercentage = round(($this->passivesCount / $this->totalResponses) * 100, 1);
        $this->detractorsPercentage = round(($this->detractorsCount / $this->totalResponses) * 100, 1);

        $this->npsScore = round($this->promotersPercentage - $this->detractorsPercentage, 1);
    }

    public function sortByFeedback($field): void
    {
        if ($this->feedbackSortBy === $field) {
            $this->feedbackSortDirection = $this->feedbackSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->feedbackSortBy = $field;
            $this->feedbackSortDirection = 'asc';
        }
    }

    public function render()
    {
        $feedbackResponses = null;

        if ($this->selectedSiteId) {
             // Base query for feedback
            $feedbackBaseQuery = NpsResponse::where('site_id', $this->selectedSiteId);

            // Apply date filter first
            $feedbackQuery = $this->applyDateFilter(clone $feedbackBaseQuery);

            // Apply search term filter
            $feedbackQuery->where(function ($query) {
                    $query->where('feedback', 'like', '%'.$this->feedbackSearch.'%')
                          ->orWhere('ip_address', 'like', '%'.$this->feedbackSearch.'%') // Search IP maybe?
                          ->orWhere('tag', 'like', '%'.$this->feedbackSearch.'%');
                });

            // Apply type filter
            if ($this->feedbackTypeFilter) {
                match ($this->feedbackTypeFilter) {
                    'Promoter' => $feedbackQuery->where('score', '>=', 9),
                    'Passive' => $feedbackQuery->whereBetween('score', [7, 8]),
                    'Detractor' => $feedbackQuery->where('score', '<=', 6),
                    default => null,
                };
            }

            // Apply sorting
            $feedbackQuery->orderBy($this->feedbackSortBy, $this->feedbackSortDirection);

            $feedbackResponses = $feedbackQuery->paginate(10, ['*'], 'feedbackPage');
        }

        return view('livewire.site-nps-dashboard', [
            'feedbackResponses' => $feedbackResponses,
        ]);
    }
}
