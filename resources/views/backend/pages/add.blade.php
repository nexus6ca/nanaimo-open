@extends('layouts.default')
@section('content')
    <form action="/backend/pages/save" method="post">
        <div class="form-group">
            <label for title>Page Title</label>
            <input type=text" class="form-control" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="page_data">Page Data</label>
            <textarea class="form-control" name="entry" rows="5"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Save Page" class="button">
            <input type="hidden" value="<?= csrf_token() ?>" name="_token">
        </div>
    </form>
@stop