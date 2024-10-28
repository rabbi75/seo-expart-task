@extends('layout.master')
@section('content')
<div>
    <div class="container">
        <h2>Project List</h2>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('project.recycle.restoreAll') }}" method="POST" id="restoreForm">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sl:</th>
                                <th scope="col">Name</th>
                                <th scope="col">Staff Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Restore</th>
                                <th scope="col">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $index => $project)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->staff->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>{{ $project->status }}</td>
                                    <td>
                                        <form action="{{ route('project.recycle.delete', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('project.recycle.restore', $project->id) }}" method="GET" onsubmit="return confirm('Are you sure you want to restore this project?');">
                                            @csrf
                                            <button type="submit" class="btn btn-info">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $project->id }}" name="project_ids[]">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary">Restore Selected</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
