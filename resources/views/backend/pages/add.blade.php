@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Page</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/backend/pages/save') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for title>Page Title</label>
                                <input type=text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="form-group">
                                <label for title>Page Catagory</label>
                                <select id="category" class="form-control" name="category" required>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->category}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="page_data">Page Data</label>
                                <textarea class="form-control" name="entry" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Save Page" class="button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

