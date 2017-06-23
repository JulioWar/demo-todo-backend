<?php

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

use Illuminate\Http\Request;


Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', function (Request $request) {
        $tasks = \App\Models\Task::where('date',date('Y-m-d'))
            ->where('user_id',$request->user()->id)
            ->get();

        $data['tasks'] = $tasks;
        return view('tasks.index',$data);
    });

    Route::get('/tasks/{date}', function (Request $request, $date) {
        $tasks = $request->user()->tasks()
            ->where('date',$date)
            ->get();

        $data['date'] = $date;
        $data['tasks'] = $tasks;
        return view('tasks.index',$data);
    });
});
