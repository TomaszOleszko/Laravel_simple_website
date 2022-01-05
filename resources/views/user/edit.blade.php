@extends('layouts.app')
@section('title',"My Software")
@section('nav')
    <a class="nav-link px-2 text-white" id="b1" href="{{ route('home') }}">Home</a>
    <a class="nav-link px-2 text-white" id="b3" href="{{route('software.index')}}">Software</a>
    <a class="nav-link px-2 text-white" id="b4" href="{{route('about')}}">About</a>
@endsection

@section('content')
    @isset($user)
        @auth
            <div class="container">
                <div class="card border border-info shadow-0 mb-3" style="max-width: 90%">
                    <div class="card-body">
                        <h5 class="card-title">Edit {{$user->name}} profile</h5>
                        <p class="card-text">
                        <div class="align-content-center">
                            <form role="form" action="{{ route('user.update', ['user' => $user]) }}" method="post" class="row g-3 align-items-center needs-validation w-90" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="col-md-6 mb-3 mt-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ $user->name  }}" placeholder="Enter name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" value="{{  $user->email }}" placeholder="Enter email" name="email" required>
                                </div>


                                <button type="submit" class="btn btn-primary btn-block rounded-pill shadow-sm">Submit</button>
                            </form>
                        </div>
                        </p>
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
    @endisset
@endsection
