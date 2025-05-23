<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function manageUsers()
    {
        return view('admin.manage-users');
    }

    public function assessments()
    {
        return view('admin.assessments');
    }
}
