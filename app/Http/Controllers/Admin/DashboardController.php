<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        UserRepository $user
    ) {
        $this->user = $user;
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
