<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers'    => User::count(),
        ]);
    }
}
