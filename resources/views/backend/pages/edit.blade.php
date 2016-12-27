@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit {{$page->title}}</div>
                    <div class="panel-body">
                        <form name="edit" action="/backend/pages/save/{{$page->id}}" method="post">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control" name="title" type="text" value="{{$page->title}}" required>
                            </div>
                            <div class="form-group">
                                <label for title>Page Catagory</label>
                                <select id="category" class="form-control" name="category" required>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->category}}" <?=($category->category == $page->category)? 'selected':''?>> {{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="entry">Page Details</label>
                                <textarea class="form-control" name="entry">{{$page->entry}}</textarea>
                            </div>
                            <input type="submit" value="Save " class="button">
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop