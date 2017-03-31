<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\SaveTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Task::query();

        if($request->get('date')) {
            $query->where('date',$request->get('date'));
        }

        return $query->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTaskRequest $request)
    {
        try {
            return Task::create($request->all());
        } catch(Exception $e) {
            return response()->json([
                "status_code" => 400,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $task = Task::findOrFail($id);
            $task->fill($request->all());
            $task->save();
            
            return $task;
        } catch(Exception $e) {
            return response()->json([
                "status_code" => 400,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $task = Task::findOrFail($id);
            $task->delete();

        } catch (Exception $e) {
            return response()->json([
                "status_code" => 400,
                "message" => $e->getMessage()
            ]);
        }
    }
}
