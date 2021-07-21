<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Illuminate\Http\Request;

class NameController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');

    }
    public function index (Name $name) {
        $tasks = $name->tasks()->with('names')->get();
        return view('tasks.index', compact('tasks'));
    }
}
