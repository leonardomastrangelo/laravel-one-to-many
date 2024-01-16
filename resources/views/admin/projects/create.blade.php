@extends('layouts.app')
@section('content')
    <section id="projects-create" class="container">
        <h1 class="display-1">Insert a Project</h1>
        <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group w-50">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required maxlength="200" minlength="3" value="{{old('title')}}">
            </div>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-group w-25">
                <label for="logo">Logo</label>
                <input type="text" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" placeholder="logo.png" maxlength="255" minlength="3" value="{{old('logo')}}">
            </div>
            @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-group w-50">
                <label for="image">Image</label>
                <div class="rectangle">
                    <img id="uploadPreview" src="https://fakeimg.pl/300x157" alt="preview">
                </div>
                <input type="file" class="form-control w-50 m-auto @error('image') is-invalid @enderror" id="image" name="image">
            </div>
            @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">
                    {{old('description')}}
                </textarea>
            </div>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>

        </form>
    </section>
@endsection
