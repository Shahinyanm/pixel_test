<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard main page
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.index', [
            'users' => User::users()->get(),
            'departments' => Department::with('users')->get()->sortByDesc('id'),
        ]);
    }
}
