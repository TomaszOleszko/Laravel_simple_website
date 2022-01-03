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
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">created at</th>
                        <th scope="col">updated at</th>
                        <th scope="col">link</th>
                        <th scope="col">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($softwares as $software)
                        <tr>
                            <th scope="row">{{$software->id}}<i class="{{$software->icon}}"></i></th>
                            <td>{{$software->title}}</td>
                            <td>{{$software->created_at}}</td>
                            <td>{{$software->updated_at}}</td>
                            <td>{{$software->link}}</td>
                            <td>{{$software->message}}
                                <br /> @if($software->user_id == \Auth::user()->id)
                                    <a href="{{route('software.edit',['software' => $software->id] )}}" class="btn btn-success btn-xs" title="Edytuj"> Edytuj</a>
                                    <form action="{{route('software.destroy',['software' => $software->id] )}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-xs" onclick="return confirm('Jesteś pewien?')" title="Delete" type="submit">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h3>Nic tu nie ma</h3>
        @endif
    @endauth
@endsection
