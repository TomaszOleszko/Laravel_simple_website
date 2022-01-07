@extends('layouts.app')
@section('title',"Software")
@section('nav')
    <a class="nav-link px-2 text-white" id="b1" href="{{ route('home') }}">Home</a>
    <a class="nav-link px-2 text-secondary disabled" id="b3" href="{{route('software.index')}}">Software</a>
    <a class="nav-link px-2 text-white" id="b4" href="{{route('about')}}">About</a>
@endsection

@section('content')
    @auth
        @if(session()->get('success'))
            <div class="w-100 container d-flex align-items-center justify-content-center">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        @if(Session::get('softwareFilter'))
                                <form action="{{route('software.index')}}" method="GET">
                                    <div class="d-grid gap-2 col-6 mx-auto float-start">
                                        <button type="submit" class="btn btn-danger" name="clicked" value="delete-filter">Delete Filter</button>
                                    </div>
                                </form>
                        @endif
                        <form role="form" action="{{route('software.index')}}" method="get">
                            {{ csrf_field() }}
                            <div class="d-grid gap-2 col-6 mx-auto float-start">
                                <button type="submit" class="btn btn-primary" >Filter</button>
                            </div>

                            <select class="form-select-lg mb-3 align-self-center" name="licences" id="licences">

                                <option value="apache2"
                                        @if (Session::get('softwareFilter')== 'apache2')
                                        selected
                                    @endif
                                >Apache License 2.0 (Apache-2.0)</option>
                                <option value="GNU3"
                                        @if (Session::get('softwareFilter') == 'GNU3')
                                        selected
                                    @endif>GNU General Public License v3.0</option>
                                <option value="MIT"
                                        @if (Session::get('softwareFilter') == 'MIT')
                                        selected
                                    @endif>MIT License</option>
                                <option value="CCZ"
                                        @if (Session::get('softwareFilter') == 'CCZ')
                                        selected
                                    @endif>Creative Commons Zero v1.0 Universal</option>
                            </select>
                            <label for="licence" class="mb-3 fs-3 align-self-center">Licence</label>
                        </form>
                    </div>
                </div>
                @if (!$softwares->isEmpty())
                    @for($i = 0; $i<count($softwares); $i+=2)

                    <div class="row d-flex justify-content-center">
                            <div class="row col-md-5 p-2 m-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$softwares[$i]->title}}</h5>
                                        <p class="card-text">{{$softwares[$i]->description}}</p>
                                        <a href="{{$softwares[$i]->link}}" class="btn btn-primary">Link</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{ $softwares[$i]->licence }}
                                        {{($softwares[$i]->created_at)->format('Y-m-d')}} at {{($softwares[$i]->created_at)->format('H:i')}}
                                    </div>
                                </div>
                            </div>
                        @if(count($softwares) > 1 && !empty($softwares[$i+1]))
                            <div class="row col-md-5 p-2 m-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$softwares[$i+1]->title}}</h5>
                                        <p class="card-text">{{$softwares[$i+1]->description}}</p>
                                        <a href="{{$softwares[$i+1]->link}}" class="btn btn-primary">Link</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{ $softwares[$i]->licence }}
                                        {{($softwares[$i+1]->created_at)->format('Y-m-d')}} at {{($softwares[$i+1]->created_at)->format('H:i')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endfor
                <div class="d-flex flex-wrap">
                    {{ $softwares->links() }}
                </div>
            </div>
        @else
            <div>
                <h2 class="d-flex justify-content-center align-items-center" >There are no Software added</h2>
            </div>
        @endif
    @endauth
@endsection
