@extends('layouts.app')
@section('content')
    <section id="projects-show">
        <h1 class="display-1">{{$category->name}}</h1>

        <div class="py-5 container text-center">
            <h2 class="fs-1 text-uppercase">Slug</h2>
            <p>{{$category->slug}}</p>
        </div>

        <div class="text-center mb-5">
            <h2 class="fs-1 text-uppercase">Operations</h2>
            <a class="btn btn-primary" href="{{route('admin.categories.edit', $category->slug)}}">Edit</a>
            <form class="d-inline-block" action="{{route('admin.categories.destroy', $category->slug)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger text-center" type="submit" data-item-title="{{$category->name}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                {{-- modal_delete --}}
                @include('partials.modal_delete')
            </form>
        </div>
        
        @forelse ($category->projects as $project)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Logo</th>
                    <th scope="col">Category</th>
                    <th scope="col">Title</th>
                    <th scope="col">Github</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <div class="logo-container">
                            <img
                            src="{{asset('storage/logos/'. $project->logo)}}"
                            alt="{{$project->title}}">
                        </div>
                    </th>
                    <td>{{($project->category) ? $project->category->name : 'Uncategorized'}}</td>
                    <td>{{$project->title}}</td>
                    <td>{{$project->github}}</td>
                    <td class="desc">{{substr($project->description, 0, 350) . '...' }}</td>
                    <td>{{$project->status == 0 ? 'In Progress' : 'Completed'}}</td>
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
            </tbody>
            </table>
        @empty
            <h3 class="text-center fw-bold display-4">No records founded</h3>
        @endforelse
    </section>
@endsection