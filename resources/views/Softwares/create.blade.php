@extends('layouts.app')
@section('title',"New software")

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
            <form role="form" action="{{route('software.store')}}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" id="title"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input name="description" id="desc"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Link</label>
                    <input name="link" id="link"/>
                </div>
                <div class="mb-3">
                    <label for="category">Icon:</label>
                    <select name="licence" id="categories">
                        <option value="apache2">Apache License 2.0 (Apache-2.0)</option>
                        <option value="GNU3">GNU General Public License v3.0</option>
                        <option value="MIT">MIT License</option>
                        <option value="CCZ">Creative Commons Zero v1.0 Universal</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" >Submit</button>
            </form>

        </div>
    @endauth
@endsection
