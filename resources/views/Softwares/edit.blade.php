@extends('layouts.app')
@section('title',"Edit software")

@section('software')
    <li class="nav-item">
        <a class="nav-link" id="b4"><i class="far fa-plus-square"></i></a>
    </li>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @auth
        <div class="container">
            <form role="form" action="{{route('software.update', ['software' => $software->id] )}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" id="title" value="{{ $software->title }}"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input name="description" id="description" value="{{ $software->description }}"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Link</label>
                    <input name="link" id="link" value="{{ $software->link }}"/>
                </div>
                <div class="mb-3">
                    <label for="category">Icon:</label>
                    <select name="licence" id="licence">
                        <option value="apache2" @if ($software->licence == 'apache2') selected @endif>Apache License 2.0 (Apache-2.0)</option>
                        <option value="GNU3" @if ($software->licence == 'GNU3') selected @endif>GNU General Public License v3.0</option>
                        <option value="MIT" @if ($software->licence == 'MIT') selected @endif>MIT License</option>
                        <option value="CCZ" @if ($software->licence == 'CCZ') selected @endif>Creative Commons Zero v1.0 Universal</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    @endauth
@endsection
