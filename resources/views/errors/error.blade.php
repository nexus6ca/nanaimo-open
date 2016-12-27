@extends('layouts.default')
@section('content')
    <label>Error on {{$page}}</label>
    <p>
        @foreach($messages as $message)
            {{$message}}
        @endforeach
    </p>
    <a class="btn btn-primary" href="/">Return to main page.</a>
@stop