<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardGroup;

class HomeController extends Controller
{
    public function index()
    {
        $dashboardGroups = DashboardGroup::get();
        return view('home', [
            'dashboardGroups' => $dashboardGroups,
        ]);
    }
}
