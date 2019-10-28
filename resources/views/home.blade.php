@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
            
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <div align="center">
                    <h1 class="display-4"> {{Auth::user()->name}}  </h1> 
                        <div class="profile mr-3">  <img src="{{Auth::user()->photo}}" alt="..." width="150" 
                            class="img-thumbnail"> </div>
                           
                            <p class="lead mb-0">  {{Auth::user()->email}}  </p> 
                            <h2> You are logged in!</h2>
                    </div>
            
                            </div>
                   
           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection