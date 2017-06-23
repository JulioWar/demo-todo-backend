@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Hola, Usuario!</h1>
            <p>hoy tenemos muchas cosas por realizar. :p</p>
        </div>
    </div>
    <div class="container agenda">
        <div class="row">
            <div class="controls col-md-3">
                <div class="navegacion">
                    <a href="" class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>

                    <a href="" class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <h3>24/9/2014</h3>
                </div>
                <form role="form" action="{{ url('tasks') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="task" style="color:white">Nueva Tarea</label>
                        <textarea class="form-control" rows="3" placeholder="Esta es una nueva Tarea."
                                  name="task"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Agregar Tarea</button>
                </form>
            </div>
            <div class="no-padding col-md-9">
                <div class="tasks">
                    <form >
                        {{ csrf_field() }}
                        <div class="description-top">
                            <h3 class="pull-left">Lista de Tareas</h3>
                            <div class="pull-right actions">
                                <button type="submit" formaction="{{ url('tasks/delete') }}" href="#" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                                <button type="submit" formaction="{{ url('tasks/edit') }}" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <button type="submit" formaction="{{ url('tasks/done') }}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-check"></span>
                                </button>
                            </div>
                        </div>
                        <ul>
                            @foreach($tasks as $task)
                                <li @if($task->done == 1) class="complete" @endif >
                                    <input type="checkbox" name="tasks[]" value="{{ $task->id }}">
                                    {{ $task->task }}
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection