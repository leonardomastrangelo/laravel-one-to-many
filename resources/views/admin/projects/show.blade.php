@extends('layouts.app')
@section('content')
    <section id="projects-show">
        <h1 class="display-1">{{$project->title}}</h1>
        <div id="project-prev">
            <img src="{{ asset('storage/uploads/' . $project->image) }}" alt="{{$project->title}}">
        </div>

        <div class="py-5 container text-center">
            <h2 class="fs-1 text-uppercase">Description</h2>
            <p>{{$project->description}}</p>
        </div>

        <div class="text-center mb-5">
            <h2 class="fs-1 text-uppercase">Operations</h2>
            <a class="btn btn-primary" href="{{route('admin.projects.edit', $project->slug)}}">Edit</a>
            <form class="d-inline-block" action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger text-center" type="submit" data-item-title="{{$project->title}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                {{-- modal_delete --}}
                @include('partials.modal_delete')
            </form>
        </div>
    </section>
@endsection