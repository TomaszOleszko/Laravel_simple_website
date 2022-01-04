@extends('layouts.app')
@section('title',"My Software")
@section('nav')
    <a class="nav-link px-2 text-white" id="b1" href="{{ route('home') }}">Home <i class="far fa-folder"></i></a>
    <a class="nav-link px-2 text-white" id="b3" href="/software">Software <i class="far fa-folder"></i></a>
    <a class="nav-link px-2 text-white" id="b4" href="/about">About <i class="far fa-folder"></i></a>
@endsection

@section('content')
    @isset($user)
    <svg height="130" width="500" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 380.34 380.34"><defs><style>.cls-1{fill:#666766;}.cls-2{fill:#fff;}.cls-3,.cls-4{fill:none;stroke-miterlimit:10;}.cls-3{stroke:#6c6c6c;}.cls-4{stroke:#fff;}</style></defs><title>icon_user_whiteongrey</title><circle class="cls-1" cx="190.17" cy="190.17" r="190.17"/><polygon class="cls-2" points="101.53 236.8 101.53 336.28 278.81 336.28 278.81 236.8 256.75 229.79 251.13 210.75 192.72 269.59 128.7 210.75 123.51 228.49 101.53 236.8"/><ellipse class="cls-2" cx="189.48" cy="129.46" rx="80.18" ry="97.25"/><path class="cls-3" d="M277.65,119.63" transform="translate(-9.56 -9.38)"/><path class="cls-3" d="M254.56,123" transform="translate(-9.56 -9.38)"/><path class="cls-4" d="M277.65,119.63" transform="translate(-9.56 -9.38)"/><path class="cls-4" d="M124.89,101.8" transform="translate(-9.56 -9.38)"/></svg>
        <h1>{{ $user->name }}</h1> <a  style="color: black" href="{{ route('user.edit', ['user' => $user]) }}">Edit</a>
        <h3>{{ $user->email }}</h3>
        <p>You have <a href="{{ route('userSoftware') }}" style="color: black">{{ count($software) }} software</a>. 
        <br><br>
        Your position in ranking is: {{ $positionInRanking }}</p>
    @endisset
@endsection