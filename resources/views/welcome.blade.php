@extends('layout.master')
@section('content')
<div>
    <div class="container">
        <h2>Project list</h2>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sl:</th>
                        <th scope="col">Name</th>
                        <th scope="col">Staff name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($projects as $project) 
                        <tr>
                        <th scope="row">1</th>
                        <td>{{$project->name}}</td>
                        <td>{{$project->staff->name}}</td>
                        <td>{{$project->description}}</td>
                        <td>{{$project->status}}</td>
                        <td>
                            <form action="{{ route('project.delete', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">Soft delete</button>
                            </form>
                        </td>
                        
                        </tr> 
                    @endforeach

                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection