<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update.task')->except([]);
    }

    public function index () {
        return view('admin.app');
    }
}
