<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskSaveRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * @description
     * Funcion para mostrar todas las tareas paara la fecha actual
     */
    public function index(Request $request)
    {
        $tasks = \App\Models\Task::where('date',date('Y-m-d'))
            ->where('user_id',$request->user()->id)
            ->get();

        $data['tasks'] = $tasks;
        $data['editable'] = [];
        return view('tasks.index',$data);
    }

    /**
     * @description
     * Funcion para mostrar todas las tareas para una fecha especifica
     */
    public function getByDate(Request $request, $date) {

        $tasks = $request->user()->tasks()
            ->where('date',$date)
            ->get();

        $data['date'] = $date;
        $data['tasks'] = $tasks;
        $data['editable'] = [];
        return view('tasks.index',$data);
    }

    /**
     * @description
     * Funcion para guardar nuevas tareas a un fecha especifica
     */
    public function store(TaskSaveRequest $request)
    {
        $task = new Task;
        $task->date = $request->get('date');
        $task->user_id = $request->user()->id;
        $task->task = $request->get('task');
        $task->done = false;
        $task->save();

        return back()->with('message', 'Guardaste la Tarea correctamente.');
    }

    /**
     * @description
     * Funcion para mostras todas las tareas que se podran editar
     */
    public function edit(Request $request, $date)
    {
        if(!$request->has('tasks')) {
            return back();
        }
        $tasks = $request->user()->tasks()
            ->where('date',$date)
            ->get();

        $data['date'] = $date;
        $data['tasks'] = $tasks;
        $data['editable'] = $request->get('tasks',[]);

        return view('tasks.index',$data);
    }

    /**
     * @description
     * Funcion para actualizar todas las tareas que seleccionadas
     */
    public function update(Request $request)
    {
        $date = $request->get('date', date('Y-m-d'));

        if($request->has('tasks')) {

            foreach($request->get('tasks') as $item) {
                $task = Task::find($item['id']);
                if(!empty($task)) {
                    $task->task = $item['task'];
                    $task->save();
                }
            }
        }

        return redirect('/tasks/'.$date)->with('message','Se han actuaizado las tareas.');
    }

    /**
     * @description
     * Funcion para eliminar todos las tareas seleccionadas
     */
    public function destroy(Request $request)
    {
        if($request->has('tasks')) {
            $tasks = $request->get('tasks');
            Task::whereIn('id', $tasks)
                ->delete();
        }
        return back();
    }

    /**
     * @description
     * Funcion para poner todos las tareas seleccionadas como completadas
     */
    public function done(Request $request) {

        if ($request->has('tasks')) {
            $tasks = $request->get('tasks');
            Task::whereIn('id', $tasks)
                ->update([
                    "done" => 1
                ]);
        }
        return back();
    }
}
