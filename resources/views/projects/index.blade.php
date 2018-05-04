@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All projects</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary btn-sm mb-3" href="{{ url('projects/create') }}">Create new project</a>

                    <ul class="list-group list-group-flush">
                        @forelse ($projects as $project)
                            <a
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                href="{{ url('projects/' . $project->id) }}"
                            >
                                {{ $project->name }}
                                <span class="badge badge-primary badge-pill">
                                    {{ $project->tasks->count() }}
                                </span>
                            </a>
                        @empty
                            <p>No project has been created!</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
