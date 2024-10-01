@extends('layouts.baseLayout')

@section('content')
    <div>
        <h2>
            Welcome to this test
        </h2>

        @isset($message)
        <div class="alert alert-success">            
            {{$message}} 
         </div>
        @endisset

        {{-- @if (session('message'))
            <div class="alert alert-success">            
               {{session('message')}} 
            </div>
        @endif --}}
    </div>
@endsection