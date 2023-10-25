<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'user']);
    }

    public function index()
    {
        return view('user.index');
    }

    public function stats()
    {
        return view('user.stats');
    }
}
