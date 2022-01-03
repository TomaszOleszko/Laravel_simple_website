@extends('layouts.app')
@section('title',"Software")
@section('nav')
    <a class="nav-link px-2 text-white" id="b1" href="{{ route('home') }}">Home <i class="far fa-folder"></i></a>
    <a class="nav-link px-2 text-secondary disabled" id="b3" href="/software">Software <i class="far fa-folder"></i></a>
    <a class="nav-link px-2 text-white" id="b4" href="/about">About <i class="far fa-folder"></i></a>
@endsection

@section('content')
    @auth
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (!empty($filter))
                @dump($filter)
            @endif
        @if (!$softwares->isEmpty())
            <div class="container">
                <form role="form" action="{{route('software.index')}}" method="get">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary" >Filter</button>
                    <label for="licence">Licence</label>
                    <select name="licences" id="licences">
                        <option value="apache2"
                            @if ($filter == 'apache2')
                                selected
                            @endif
                            >Apache License 2.0 (Apache-2.0)</option>
                        <option value="GNU3"
                            @if ($filter == 'GNU3')
                                selected
                            @endif>GNU General Public License v3.0</option>
                        <option value="MIT"
                            @if ($filter == 'MIT')
                                selected
                            @endif>MIT License</option>
                        <option value="CCZ"
                            @if ($filter == 'CCZ')
                                selected
                            @endif>Creative Commons Zero v1.0 Universal</option>
                    </select>
                </form>
                
                    @for($i = 0; $i<count($softwares); $i+=2)

                    <div class="row">
                            <div class="row col-md-5 p-2 m-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$softwares[$i]->title}}</h5>
                                        <p class="card-text">{{ $softwares[$i]->licence }}  {{$softwares[$i]->description}}</p>
                                        <a href="{{$softwares[$i]->link}}" class="btn btn-primary">Link</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{$softwares[$i]->created_at}}
                                    </div>
                                </div>
                            </div>
                        @if(count($softwares) > 1)
                            <div class="row col-md-5 p-2 m-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$softwares[$i+1]->title}}</h5>
                                        <p class="card-text">{{$softwares[$i+1]->description}}</p>
                                        <a href="{{$softwares[$i+1]->link}}" class="btn btn-primary">Link</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{$softwares[$i+1]->created_at}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endfor
            </div>
        @else
            <h3></h3>
        @endif
    @endauth
@endsection
