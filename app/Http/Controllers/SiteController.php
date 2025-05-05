<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;

class SiteController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sites = Auth::user()->sites()->latest()->get();
        $canCreateMore = Auth::user()->canCreateMoreSites();

        return view('sites.index', compact('sites', 'canCreateMore'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|RedirectResponse
    {
        if (!Auth::user()->canCreateMoreSites()) {
            return redirect()->route('sites.index')
                ->with('error', 'Je hebt het maximale aantal sites voor je pakket bereikt.');
        }
        return view('sites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::user()->canCreateMoreSites()) {
            return redirect()->route('sites.index')
                ->with('error', 'Je hebt het maximale aantal sites voor je pakket bereikt.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:sites,domain',
            'allowed_paths_input' => 'nullable|string',
        ]);

        $allowedPaths = $this->parseAllowedPaths($request->input('allowed_paths_input'));

        Auth::user()->sites()->create([
            'name' => $validated['name'],
            'domain' => $validated['domain'],
            'public_id' => (string) Str::uuid(),
            'allowed_paths' => $allowedPaths,
        ]);

        return redirect()->route('sites.index')
            ->with('success', 'Site succesvol aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        $this->authorize('view', $site);
        // For now, redirect to edit or index, as we don't have a dedicated show view yet.
        return redirect()->route('sites.edit', $site);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site): View
    {
        $this->authorize('update', $site);
        return view('sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site): RedirectResponse
    {
        $this->authorize('update', $site);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:sites,domain,' . $site->id,
            'allowed_paths_input' => 'nullable|string',
        ]);

        $allowedPaths = $this->parseAllowedPaths($request->input('allowed_paths_input'));

        $site->update([
            'name' => $validated['name'],
            'domain' => $validated['domain'],
            'allowed_paths' => $allowedPaths,
        ]);

        return redirect()->route('sites.index')
            ->with('success', 'Site succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site): RedirectResponse
    {
        $this->authorize('delete', $site);
        $site->delete();

        return redirect()->route('sites.index')
             ->with('success', 'Site succesvol verwijderd.');
    }

    /**
     * Parse the newline-separated string of paths from the textarea into an array.
     *
     * @param string|null $pathsInput
     * @return array|null Returns null if input is empty/null, otherwise an array of paths.
     */
    private function parseAllowedPaths(?string $pathsInput): ?array
    {
        if (empty($pathsInput)) {
            return null; // Store null if empty, meaning allow all pages
        }

        $paths = preg_split('/\r\n|\r|\n/', $pathsInput);

        return collect($paths)
            ->map(fn($path) => trim($path))
            ->filter(fn($path) => !empty($path) && str_starts_with($path, '/')) // Ensure path starts with /
            ->unique()
            ->values()
            ->all();
    }
}
