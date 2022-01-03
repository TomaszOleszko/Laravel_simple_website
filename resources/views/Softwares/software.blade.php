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
        @if (!$softwares->isEmpty())
            <div class="container">
                <form role="form" action="{{route('software.index')}}" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary" >Filter</button>
                    <label for="licence">Licence</label>
                    <select name="licences" id="licences">
                        <option value="apache2">Apache License 2.0 (Apache-2.0)</option>
                        <option value="GNU3">GNU General Public License v3.0</option>
                        <option value="MIT">MIT License</option>
                        <option value="CCZ">Creative Commons Zero v1.0 Universal</option>
                    </select>

                </form>

                    <div class="row">
                    @foreach($softwares as $software)
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$software->title}}</h5>
                                        <p class="card-text">{{$software->description}}</p>
                                        <a href="{{$software->link}}" class="btn btn-primary">Link</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{$software->created_at}}
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    </div>
            </div>
        @else
            <h3></h3>
        @endif
    @endauth
@endsection
