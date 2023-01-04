<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    JenisMadrasahRepository,
    ProgramMadrasahRepository
};

class FrontController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return view('welcome');
    }
}
