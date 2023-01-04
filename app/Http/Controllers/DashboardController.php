<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    UserRepository
};

class DashboardController extends Controller
{
    public function __construct(
        UserRepository $user
    ) {
        $this->user = $user;
    }

    public function index()
    {
        return view('dashboard');
    }
}
