@extends('layouts.default')
@section('content')
    <form name="edit" action="/backend/pages/save/{{$page->id}}" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" name="title" type="text" value="{{$page->title}}" required>
        </div>
        <div class="form-group">
            <label for="entry">Page Details</label>
            <textarea class="form-control" name="entry">{{$page->entry}}</textarea>
        </div>
        <input type="submit" value="Save " class="button">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
    </form>
@stop