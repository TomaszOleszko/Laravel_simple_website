@extends('layouts.app')
@section('title',"My Software")
@section('nav')
    <a class="nav-link px-2 text-white" id="b1" href="{{ route('home') }}">Home</a>
    <a class="nav-link px-2 text-white" id="b3" href="{{route('software.index')}}">Software</a>
    <a class="nav-link px-2 text-white" id="b4" href="{{route('about')}}">About</a>
@endsection

@section('content')
    @isset($user)

        <section class="vh-80">
            <div class="container py-5 h-75">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-md-9 col-lg-7 col-xl-5">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <div class="d-flex text-black">

                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1">{{$user->name}}</h5>
                                        <p class="mb-2 pb-1" style="color: #2b2a2a;">{{$user->email}}</p>
                                        <div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #efefef;">
                                            <div class="px-3">
                                                <p class="small text-muted mb-1">Software</p>
                                                <p class="mb-0">{{ count($software) }}</p>
                                            </div>
                                            <div class="px-3">
                                                <p class="small text-muted mb-1">Ranking</p>
                                                <p class="mb-0"> @if(is_null($positionInRanking)) Last @else {{$positionInRanking}} @endif</p>
                                            </div>
                                            <div class="px-3">
                                                <p class="small text-muted mb-1">Rating</p>
                                                <p class="mb-0"> @if(is_null($positionInRanking)) 0.0 @else {{$positionInRanking/count($software)}} @endif</p>
                                            </div>
                                            <div class="px-3">
                                                <p class="small text-muted mb-1">Created at</p>
                                                <p class="mb-0"> @if((date('Y')-$user->created_at->format('Y')) == 0)
                                                        @if(date('m')-$user->created_at->format('m') == 0)
                                                            @if(date('d')-$user->created_at->format('d') == 0)
                                                                Just now
                                                            @else
                                                                {{date('d')-$user->created_at->format('d')}} days ago
                                                            @endif
                                                        @else
                                                            {{date('m')-$user->created_at->format('m')}} months ago
                                                        @endif
                                                    @else
                                                        {{date('Y')-$user->created_at->format('Y')}} years ago
                                                    @endif </p>
                                            </div>
                                            <div class="px-3">
                                                <p class="small text-muted mb-1">Updated at</p>
                                                <p class="mb-0"> @if((date('Y')-$user->updated_at->format('Y')) == 0)
                                                        @if(date('m')-$user->updated_at->format('m') == 0)
                                                            @if(date('d')-$user->updated_at->format('d') == 0)
                                                                Just now
                                                            @else
                                                                {{date('d')-$user->updated_at->format('d')}} days ago
                                                            @endif
                                                        @else
                                                            {{date('m')-$user->updated_at->format('m')}} months ago
                                                        @endif
                                                    @else
                                                        {{date('Y')-$user->updated_at->format('Y')}} years ago
                                                    @endif </p>
                                            </div>
                                        </div>
                                        <div class="d-flex pt-1">
                                            <button class="btn btn-outline-dark me-1 flex-grow-1" data-mdb-ripple-color="dark" style="z-index: 1;">
                                                <a  style="color: black" href="{{ route('user.edit', ['user' => $user]) }}">Edit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset
@endsection
