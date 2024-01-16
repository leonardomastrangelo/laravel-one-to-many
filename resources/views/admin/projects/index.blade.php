@extends('layouts.app')
@section('content')
    <section id="projects-index" class="container-fluid">
        <h1 class="display-1">My projects</h1>

        @if (session()->has('success'))
            <div class="alert alert-danger d-inline-block">
                {{session('success')}}
            </div>
        @endif
        
        {{-- PROJECTS' TABLE --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Logo</th>
                    <th scope="col">ID</th>
                    <th scope="col">User_ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <th scope="row">
                        <div class="logo-container">
                            <img
                            src="{{asset('storage/logos/'. $project->logo)}}"
                            alt="{{$project->title}}">
                        </div>
                    </th>
                    <td>{{$project->id}}</td>
                    <td>{{$project->user_id}}</td>
                    <td>{{$project->title}}</td>
                    <td class="desc">{{substr($project->description, 0, 350) . '...' }}</td>
                    <td> {{-- OPERATIONS --}}
                        <a class="btn btn-info" href="{{route('admin.projects.show', $project->slug)}}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a class="btn btn-warning" href="{{route('admin.projects.edit', $project->slug)}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-center" type="submit" data-item-title="{{$project->title}}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            {{-- modal_delete --}}
                            @include('partials.modal_delete')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </section>
@endsection