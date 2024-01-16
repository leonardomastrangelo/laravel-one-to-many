@extends('layouts.app')
@section('content')
    <section id="projects-index" class="container-fluid">
        <h1 class="display-1">Categories</h1>

        @if (session()->has('success'))
            <div class="alert alert-danger d-inline-block">
                {{session('success')}}
            </div>
        @endif
        
        {{-- PROJECTS' TABLE --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th scope="row">
                        {{$category->id}}
                    </th>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        {{$category->slug}}
                    </td>
                    <td> {{-- OPERATIONS --}}
                        <a class="btn btn-info" href="{{route('admin.categories.show', $category->slug)}}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a class="btn btn-warning" href="{{route('admin.categories.edit', $category->slug)}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{route('admin.categories.destroy', $category->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-center" type="submit" data-item-title="{{$category->name}}">
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