<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\PushallServiceController;
use \Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('/', function () {
    return view('loaut.dashboard');
});

//Route::get('/test', function (){
//    session(['test'=> 'Hello world']);
//    return session()->get('test');
//});


Route::get('/test',function () {
   $users =  \App\Models\User::withCount(['tasks' => function ($q) {
       $q->new();
   }])->get();
    $users->load('tasks','tasks.box');
   return $users;
});
//Route::get('/querybilder',function (){
//        $tasks = DB::table('tasks')->orderBy('id')->where('completed', false)
//            ->chunk(2,function ($tasks){
//                foreach ($tasks as $task) {
//                    DB::table('tasks')->where('id', $tasks->pluck('id'))->update(['completed' => true]);
//                }
//               dump($tasks);
//            });
//});

Route::get('/querybilder',function (){
    $users = DB::table('users')
//        ->join('tasks',  'users.id', '=', 'tasks.owner_id')
        ->leftjoin('companies', 'users.id', '=', 'companies.owner_id')
        ->select('users.id','users.email','companies.name')
        ->get();

    dump($users);
});

Route::get('/testNew',function () {
    \App\Models\Company::first()->user()->associate(\App\Models\User::first());
    \App\Models\Company::first()->user()->dissociate();
    \App\Models\Company::first()->user;

});

//vercnel yusernerin tasker@  update exac verji jamanakov
Route::get('/completedtask',function (){

    $latestTask = DB::table('tasks')
        ->select('owner_id', DB::raw('MAX(updated_at) as hello_updated_at'))
        ->where('completed', false)
        ->groupBy('owner_id');

    $users = DB::table('users')
        ->joinSub($latestTask,'latest_completed_task',function ($join){
            $join->on('users.id', '=','latest_completed_task.owner_id');
        })->get();
    dump($users);


});

Route::get('/test1',function (){
   $tasks = DB::table('tasks')
       ->where('type', '=','old')
       ->orWhere('type', '=', 'Fast')
       ->get();
   dump($tasks);
});




Route::get('/tasks/names/{name}',[NameController::class,'index']);

Route::resources([
    'tasks' => TasksController::class,
]);

Route::get('/admin',[\App\Http\Controllers\AdminController::class,'index']);

Route::patch('/boxes/{box}', [BoxController::class,'update']);
Route::post('/boxes',[BoxController::class,'store']);

Route::get('/service',[PushallServiceController::class,'form'])->middleware('auth');
Route::post('/service',[PushallServiceController::class,'send'])->middleware('auth');

Auth::routes();

Route::post('/companies',function () {
        $attributes = request()->validate(['name' => 'required']);
        $attributes['owner_id'] = auth()->id();

        \App\Models\Company::create($attributes);

});
