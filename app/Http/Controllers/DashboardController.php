<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\DashboardGroup;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dashboards = Dashboard::where('is_active', 1)->get();

        $dashboardGroups = DashboardGroup::get();

        return view('dashboard.index', [
            'dashboards' => $dashboards,
            'dashboardGroups' => $dashboardGroups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dashboardGroups = DashboardGroup::get();
        return view('dashboard.form', [
            'dashboardGroups' => $dashboardGroups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link'=> 'required|url',
        ]);

        if(isset($request->group_id)){
            $request->validate([
                'group_id' => 'exists:dashboard_groups,id',
            ]);

            $group_id = $request->group_id;
        }else{
            $request->validate([
                'group_name' => 'string|max:255',
            ]);

            $group_id=DashboardGroup::create(['name' => $request->group_name])->id;
        }

        Dashboard::create([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'group_id' => $group_id,
            'is_active' => true
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Dashboard created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dashboard = Dashboard::findOrFail($id);
        return view('dashboard.show', [
            'dashboard' => $dashboard,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dashboard = Dashboard::findOrFail($id);
        $dashboardGroups = DashboardGroup::get();

        return view('dashboard.form', [
            'dashboard' => $dashboard,
            'dashboardGroups' => $dashboardGroups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link'=> 'required|url',
            'group_id' => 'required|exists:dashboard_groups,id',
        ]);

        $dashboard = Dashboard::findOrFail($id);
        $dashboard->update($request->all());

        return redirect()->route('dashboard.index')->with('success', 'Dashboard updated successfully.');
    }

    public function disableEnable(string $id)
    {
        $dashboard = Dashboard::findOrFail($id);

        if ($dashboard->is_active){
            $dasboard->update([
                'is_active' => false,
            ]);

            return redirect()->route('dashboard.index')->with('success', 'Dashboard disabled successfully.');

        }else{
            $dashboard->update([
                'is_active'=>true,
            ]);
            return redirect()->route('dashboard.index')->with('success', 'Dashboard enabled successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dashboard = Dashboard::findOrFail($id);
        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Dashboard deleted successfully.');
    }
}
