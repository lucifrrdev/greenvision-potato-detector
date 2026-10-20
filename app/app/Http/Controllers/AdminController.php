<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Detection;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalDetections = Detection::count();

        $healthyCount = Detection::where(function($query) {
            $query->where('disease_name', 'like', '%sehat%')
                  ->orWhere('disease_name', 'like', '%healthy%');
        })->count();

        $earlyBlightCount = Detection::where(function($query) {
            $query->where('disease_name', 'like', '%early%')
                  ->orWhere('disease_name', 'like', '%bercak%');
        })->count();

        $lateBlightCount = Detection::where(function($query) {
            $query->where('disease_name', 'like', '%late%')
                  ->orWhere('disease_name', 'like', '%busuk%');
        })->count();

        $sickCount = Detection::where(function($query) {
            $query->where('disease_name', 'not like', '%sehat%')
                  ->where('disease_name', 'not like', '%healthy%');
        })->count();

        $recentDetections = Detection::with('user')->latest()->limit(5)->get();
        $recentUsers = User::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDetections',
            'healthyCount',
            'sickCount',
            'earlyBlightCount',
            'lateBlightCount',
            'recentDetections',
            'recentUsers'
        ));
    }
}
