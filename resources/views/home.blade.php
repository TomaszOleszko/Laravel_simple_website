@extends('layouts.app')
@section('title','Home')
@section('nav')
            <a class="nav-link px-2 text-secondary disabled" id="b1" href="{{ route('home') }}">Home <i class="far fa-folder"></i></a>
            <a class="nav-link px-2 text-white" id="b3" href="/software">Software <i class="far fa-folder"></i></a>
            <a class="nav-link px-2 text-white" id="b4" href="/about">About <i class="far fa-folder"></i></a>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h2>Your stats:</h2>
                        <ul>
                            <li>
                                Member for {{date('Y')-$user->created_at->format('Y')}} years
                            </li>
                            <li>
                                Softwares added: {{$userSoftwaresCount}}
                            </li>
                        </ul>
                        <h2>Overall stats:</h2>
                        <ul>
                            <li>
                                Registered users: {{$userCount}}
                            </li>
                            <li>
                                Number of Softwares: {{$softwareCount}}
                            </li>
                            <li>
                                Most popular licence: {{$popularLicence}}
                            </li>
                            <li>
                                Most active user: {{$popularUser}}
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
