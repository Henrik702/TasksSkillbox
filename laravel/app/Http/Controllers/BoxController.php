<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Notifications\BoxTaskCompleted;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'description' => 'required|min:10',
        ]);
        $box = Box::create([
           'description'=> $request -> description,
            'task_id' => $request -> task_id,
        ]);

        auth()->user()->notify(new BoxTaskCompleted());
        return back();
        }
    public function update(Box $box) {
        $box->update(['completed' => \request()->has('completed')]);

        return back();
    }

}
