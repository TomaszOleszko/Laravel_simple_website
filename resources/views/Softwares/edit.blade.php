@extends('layouts.app')
@section('title',"Edit software")

@section('nav')
    <a class="nav-link px-2 text-white" id="b1" href="{{ route('home') }}">Home </a>
    <a class="nav-link px-2 text-white" id="b3" href="{{route('software.index')}}">Software</a>
    <a class="nav-link px-2 text-white" id="b4" href="{{route('about')}}">About</a>
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
        <div class="card border border-info shadow-0 mb-3" style="max-width: 90%">
            <div class="card-body">
                <h5 class="card-title">New software</h5>

                <div class="align-content-center">
                    <form  action="{{route('software.update', ['software' => $software->id] )}}" method="post" class="row g-3 align-items-center needs-validation w-90" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="col-md-6 mb-3 mt-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" value="{{ $software->title }}" placeholder="Enter Title" name="title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="link" class="form-label">Link:</label>
                            <input type="url" class="form-control" id="link" value="{{ $software->link }}" placeholder="Enter url" name="link" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc">Description:</label>
                            <textarea class="form-control" rows="5" id="desc" name="description" required>{{ $software->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <select class="form-select " name="licence" id="categories" aria-label="Default select example">
                                <option value="apache2" @if ($software->licence == 'apache2') selected @endif>Apache License 2.0 (Apache-2.0)</option>
                                <option value="GNU3" @if ($software->licence == 'GNU3') selected @endif>GNU General Public License v3.0</option>
                                <option value="MIT" @if ($software->licence == 'MIT')selected @endif>MIT License</option>
                                <option value="CCZ" @if ($software->licence == 'CCZ') selected @endif>Creative Commons Zero v1.0 Universal</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block rounded-pill shadow-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    @endauth
@endsection
