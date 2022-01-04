@extends('layouts.app')
@section('title','Home')
@section('nav')
            <a class="nav-link px-2 text-secondary disabled" id="b1" href="{{ route('home') }}">Home</a>
            <a class="nav-link px-2 text-white" id="b3" href="{{route('software.index')}}">Software</a>
            <a class="nav-link px-2 text-white" id="b4" href="{{route('about')}}">About</a>
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
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Your stats:</h2>
                            <ul>
                                <li>
                                    @if((date('Y')-$user->created_at->format('Y')) == 0)
                                        @if(date('m')-$user->created_at->format('m') == 0)
                                            @if(date('d')-$user->created_at->format('d') == 0)
                                                Member from today
                                            @else
                                                Member for {{date('d')-$user->created_at->format('d')}} days
                                            @endif
                                        @else
                                            Member for {{date('m')-$user->created_at->format('m')}} months
                                        @endif
                                    @else
                                        Member for {{date('Y')-$user->created_at->format('Y')}} years
                                    @endif
                                </li>
                                <li>
                                    Softwares added: {{$userSoftwaresCount}}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h2>Overall stats:</h2>
                            <ul>
                                <li>
                                    Registered users: {{$userCount}}
                                </li>
                                <li>
                                    Number of Software added: {{$softwareCount}}
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
    </div>
</div>
@endsection
