@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $project->name }}</div>

                <div class="card-body">
                    <p>{{ $project->description }}</p>

                    <a href="" class="btn btn-primary btn-sm">Mark as completed</a>

                    <hr>

                    <form method="POST" action="{{ url('tasks') }}">
                        @csrf

                        <div class="input-group">
                            <input type="hidden" name="project_id" value="{{ $project->id }}">

                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="Task title">

                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif

                            <div class="input-group-append">
                                <button class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>

                    <ul class="list-group mt-3">
                        @forelse ($project->tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $task->title }}

                                <input type="checkbox">
                            </li>
                        @empty
                            <p>No tasks assigned to this project!</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
