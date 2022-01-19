@extends('layouts.app')
@section('title',"About")
@section('nav')
    <a class="nav-link px-2 text-white" id="b1" href="{{ route('home') }}">Home</a>
    <a class="nav-link px-2 text-white" id="b3" href="{{route('software.index')}}">Software</a>
    <a class="nav-link px-2 text-secondary disabled" id="b4" href="{{route('about')}}">About</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">About</div>

                    <div class="card-body">
    <div class="row" style="margin: 3em;">
        <div class="text-lg-start">
          <h1>What is open source software?</h1>
          <h2> Open source software is software with source code that anyone can inspect, modify, and enhance.</h2>
          <h3 class="text-left">The distribution terms of open-source software must comply with the following</h3>
              <ul>
                  <li>1. Free Redistribution</li>
                  <li>2. Source Code</li>
                  <li>3. Derived Works</li>
                  <li>4. Integrity of The Author's Source Code</li>
                  <li>5. No Discrimination Against Persons or Groups</li>
                  <li>6. No Discrimination Against Fields of Endeavor</li>
                  <li>7. Distribution of License</li>
                  <li>8. License Must Not Be Specific to a Product</li>
                  <li>9. License Must Not Restrict Other Software</li>
                  <li>10. License Must Be Technology-Neutral</li>
              </ul>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row footer_row">
                <div class="col-lg-12 footer_col">
                    <div class="footer_item text-center">
                        <div class="footer_icon d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
                            <div class="footer_list text-muted">tomasz.oleszko@pollub.edu.pl</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
