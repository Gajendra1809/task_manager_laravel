<?php

use App\Http\Requests\TaskRequest;
use \App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/','/tasks');


//get all tasks
Route::get('/tasks', function () {
    //$tasks=\App\Models\Task::all();
    $tasks=Task::latest()->get();  //to get the latest added tasks
    return view('index',[
        'tasks'=> $tasks
    ]);
})->name('tasks.index');


//create task form
Route::view('/tasks/create','create')->name('tasks.create');


//update an specific task
Route::get('/tasks/{task}/edit',function(Task $task) {
    //$task=Task::findOrFail($id);
    return view('edit',['task'=>$task]);
})->name('tasks.edit');


//get specific task
Route::get('/tasks/{task}',function(Task $task) {
    //$task=Task::findOrFail($id);
    return view('show',['task'=>$task]);
})->name('tasks.show');


//getting form data and storing it into DB
Route::post('/tasks',function(TaskRequest $request){
    // $data=$request->validated();
    // $task=new Task;
    // $task->title=$data['title'];
    // $task->description=$data['description'];
    // $task->long_description=$data['long_description'];
    // $task->save(); //insert query
    $task=Task::create($request->validated());
                                                             //flash message to show one time session                       
    return redirect()->route('tasks.show',['task'=>$task->id])->with('success','Task created successfully');
})->name('tasks.store');


//getting update form data and updating
Route::put('/tasks/{task}',function(Task $task,TaskRequest $request){

    //$task=Task::findOrFail($id);
    // $data=$request->validated();
    // $task->title=$data['title'];
    // $task->description=$data['description'];
    // $task->long_description=$data['long_description'];
    // $task->save(); //insert query
    $task->update($request->validated());
                                                             //flash message to show one time session                       
    return redirect()->route('tasks.show',['task'=>$task->id])->with('success','Task updated successfully');
})->name('tasks.update');

Route::delete('/tasks/{task}',function(Task $task){
    $tname=$task->title;
    $task->delete();

    return redirect()->route('tasks.index')->with('success','Task named => '.$tname.' deleted successfully');
})->name('tasks.destroy');

//handling url's that don't exit
Route::fallback(function(){
    return "Some error !";
});