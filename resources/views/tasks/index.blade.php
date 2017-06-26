@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@php
    $today = (isset($date)) ? $date : date('Y-m-d');

    $date = new DateTime($today);
    $date->modify('-1 day');
    $yesterday = $date->format('Y-m-d');

    $date->modify('+2 day');
    $tomorrow = $date->format('Y-m-d');
@endphp

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Hola, {{ Auth::user()->name }}!</h1>
            <p>hoy tenemos muchas cosas por realizar. :p</p>
        </div>
    </div>
    <div class="container agenda">
        <div class="row">
            <div class="controls col-md-3">
                <div class="navegacion">
                    <a href="{{ url('tasks/'.$yesterday) }}" class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>

                    <a href="{{ url('tasks/'.$tomorrow) }}" class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <h3>{{ $today }}</h3>
                </div>
                <form role="form" action="{{ url('tasks') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="date" value="{{ $today }}">
                    <div class="form-group">
                        <label for="task" style="color:white">Nueva Tarea</label>
                        <textarea class="form-control" rows="3" placeholder="Esta es una nueva Tarea."
                                  name="task"></textarea>
                    </div>
                    @if(count($errors->all()) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-success pull-right">Agregar Tarea</button>
                </form>
            </div>
            <div class="no-padding col-md-9">
                <div class="tasks">
                    <form action="{{ url('tasks/update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="date" value="{{ $today }}">
                        <div class="description-top">
                            <h3 class="pull-left">Lista de Tareas</h3>
                            <div class="pull-right actions">
                                @if(count($editable) == 0)
                                    <button type="submit" formaction="{{ url('tasks/delete') }}" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                    <button type="submit" formaction="{{ url('tasks/'.$today.'/edit') }}" class="btn btn-warning">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button type="submit" formaction="{{ url('tasks/done') }}" class="btn btn-default">
                                        <span class="glyphicon glyphicon-check"></span>
                                    </button>
                                @else
                                    <button type="submit" formaction="{{ url('tasks/update') }}" class="btn btn-success">
                                        Actualizar
                                    </button>
                                @endif
                            </div>
                        </div>
                        <ul>
                            @foreach($tasks as $task)
                                @component('components.task',['task' => $task, 'is_editable' => in_array($task->id,$editable) ])
                                @endcomponent
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection