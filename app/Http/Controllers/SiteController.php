<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        ]);

        Auth::user()->sites()->create([
            'name' => $validated['name'],
            'domain' => $validated['domain'],
            'public_id' => (string) Str::uuid(),
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
            // Domain unique check should ignore the current site's domain
            'domain' => 'required|string|max:255|unique:sites,domain,' . $site->id,
        ]);

        $site->update($validated);

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
}
