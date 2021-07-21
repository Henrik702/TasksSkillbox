<?php

namespace App\Http\Controllers;

use App\Events\TaskCreate;
use App\Mail\TaskCreated;
use App\Models\Box;
use App\Models\Name;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('can:update,task')->except(['index','show','create','store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('owner_id', auth()->id())->with('names')->latest()->paginate(4);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes =  $request ->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:5',
        ]);
        $attributes['owner_id'] = auth()->id();
        $task =  Task::create($attributes);

        session()->flash('massage', 'Հաջողոտյամբ մշակված է');

        \Mail::to($task->owner->email)->send(
          new TaskCreated($task)
        );



        event(new TaskCreate($task));
        return redirect('/tasks');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::with('box')->find($id);
        $box = Box::first();
        return view('tasks.idCreate',compact('task' , 'box'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)

    {
//        $this->authorize('update',$task);
//        $task = Task::find($id);
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Task $task)
    {
        $attributes = \request()->validate([
            'title'=> 'required',
            'body' => 'required',
        ]);
        $task->update($attributes);
        $taskName = $task->names->keyBy('name');
        $names = collect(explode(',',request('names')))->keyBy(function ($item) { return $item; });

        $syncIds = $taskName->intersectByKeys($names)->pluck('id')->toArray();
        $namesToAttach = $names->diffKeys($taskName);

        foreach ($namesToAttach as $name) {
            $name = Name::firstOrCreate(['name' => $name]);
            $syncIds[] = $name->id;
        }
//        $namesToAttach = $names->diffKeys($taskName);
//        $namesToDetach = $taskName->diffkeys($names);
//        foreach ($namesToAttach as $name){
//            $name = Name::firstOrCreate(['name' => $name]);
//            $task->names()->attach($name);
//        }
//        foreach ($namesToDetach as $name){
//            $task->names()->detach($name);
//        }
        $task->names()->sync($syncIds);
        return redirect('/tasks/'.$task->id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Task::find($id)->delete();

        session()->flash('delete', 'Հաջողոտյամբ Ջնջվել է');

        return redirect('/tasks');
    }
}
