@extends('layouts.baseLayout')

@section('content')
    <div>
        <h2>
            Welcome to this test
        </h2>

        @if (session('message'))
            <div class="alert alert-success">            
               {{session('message')}} 
            </div>
        @endif
    </div>
@endsection