<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardGroup;

class DashboardGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('group.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        
        DashboardGroup::create([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Dashboard group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $group = DashboardGroup::findOrFail($id);
        return view('group.form', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group = DashboardGroup::findOrFail($id);
        $group->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Dashboard group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = DashboardGroup::findOrFail($id);
        
        // Check if the group has any dashboards
        if ($group->dashboards()->count() > 0) {
            return redirect()->route('dashboard.index')->with('error', 'Cannot delete group with existing dashboards.');
        }

        $group->delete();
        return redirect()->route('dashboard.index')->with('success', 'Dashboard group deleted successfully.');
    }
}
