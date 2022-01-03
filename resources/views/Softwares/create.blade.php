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
        <div class="container align-content-center">
            <form role="form" action="{{route('software.store')}}" method="post" class="row g-3 align-items-center needs-validation w-90" novalidate>
                @csrf

                <div class="col-md-6 mb-3 mt-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="link" class="form-label">Link:</label>
                    <input type="url" class="form-control" id="link" placeholder="Enter url" name="link" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea class="form-control" rows="5" id="desc" name="description" required></textarea>
                </div>

                <div class="mb-3">
                    <select class="form-select " name="licence" id="categories" aria-label="Default select example">
                        <option selected value="apache2">Apache License 2.0 (Apache-2.0)</option>
                        <option value="GNU3">GNU General Public License v3.0</option>
                        <option value="MIT">MIT License</option>
                        <option value="CCZ">Creative Commons Zero v1.0 Universal</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
