@extends('layouts.app')
@section('title',"My Software")
@section('nav')
    <a class="nav-link px-2 text-white" id="b1" href="{{ route('home') }}">Home</a>
    <a class="nav-link px-2 text-white" id="b3" href="{{route('software.index')}}">Software</a>
    <a class="nav-link px-2 text-white" id="b4" href="{{route('about')}}">About</a>
@endsection

@section('content')
    @auth
        @if(session()->get('success'))
            <div class="w-100 container d-flex align-items-center justify-content-center">
                <div class="alert alert-success ">
                    {{ session()->get('success') }}
                </div>
            </div>
        @endif
        @if ($hasSoftware)
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        @if(Session::get('userSoftwareFilter'))
                            <form action="{{route('userSoftware')}}" method="GET">
                                <div class="d-grid gap-2 col-6 mx-auto float-start">
                                    <button type="submit" class="btn btn-danger" name="clicked" value="delete-filter">Delete Filter</button>
                                </div>
                            </form>
                        @endif
                        <form role="form" action="{{route('userSoftware')}}" method="GET">
                            {{ csrf_field() }}
                            <div class="d-grid gap-2 col-6 mx-auto float-start">
                                <button type="submit" class="btn btn-primary" >Filter</button>
                            </div>
                            <select class="form-select-lg mb-3 align-self-center" name="licences" id="licences">
                                <option value="apache2"
                                        @if (Session::get('userSoftwareFilter')== 'apache2')
                                        selected
                                    @endif
                                >Apache License 2.0 (Apache-2.0)</option>
                                <option value="GNU3"
                                        @if (Session::get('userSoftwareFilter') == 'GNU3')
                                        selected
                                    @endif>GNU General Public License v3.0</option>
                                <option value="MIT"
                                        @if (Session::get('userSoftwareFilter') == 'MIT')
                                        selected
                                    @endif>MIT License</option>
                                <option value="CCZ"
                                        @if (Session::get('userSoftwareFilter') == 'CCZ')
                                        selected
                                    @endif>Creative Commons Zero v1.0 Universal</option>
                            </select>
                            <label for="licence" class="mb-3 fs-3 align-self-center">Licence</label>
                        </form>
                    </div>
                </div>
                @if (count($softwares))
                    @for($i = 0; $i<count($softwares); $i+=2)
                    <div class="row">
                        <div class="row col-md-5 p-2 m-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{$softwares[$i]->title}}</h5>
                                    <p class="card-text">{{$softwares[$i]->description}}</p>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="row text-center">
                                            <a href="{{$softwares[$i]->link}}" class="btn btn-primary w-100 p-0 m-0">Link</a>
                                            @if($softwares[$i]->user_id == \Auth::user()->id)
                                                <a href="{{route('software.edit',['software' => $softwares[$i]->id] )}}" class="btn btn-success btn-xs w-100 p-0 m-0" title="Edytuj"> Edytuj</a>
                                                <form action="{{route('software.destroy',['software' => $softwares[$i]->id] )}}" class="p-0" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-xs w-100 p-0 m-0" onclick="return confirm('Jesteś pewien?')" title="Delete" type="submit">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
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
                                    </div>
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row text-center">
                                                <a href="{{$softwares[$i+1]->link}}" class="btn btn-primary w-100 p-0 m-0">Link</a>
                                                @if($softwares[$i+1]->user_id == \Auth::user()->id)
                                                    <a href="{{route('software.edit',['software' => $softwares[$i+1]->id] )}}" class="btn btn-success btn-xs w-100 p-0 m-0" title="Edytuj"> Edytuj</a>
                                                    <form action="{{route('software.destroy',['software' => $softwares[$i+1]->id] )}}" class="p-0" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-xs w-100 p-0 m-0" onclick="return confirm('Jesteś pewien?')" title="Delete" type="submit">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{($softwares[$i+1]->created_at)->format('Y-m-d')}} at {{($softwares[$i+1]->created_at)->format('H:i')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endfor
                @else
                    <h2>Nie masz żadnego software'u z kryterium {{ Session::get('userSoftwareFilter') }}</h2>
                @endif

            </div>
        @else
            <h3>You don't have any software</h3>
        @endif
    @endauth
@endsection
