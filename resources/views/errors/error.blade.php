@extends('layouts.default')
@section('content')
    <label>Error on {{$page}}</label>
    <p>
            {{$messages}}
    </p>
    <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
@stop