@extends('layouts.default')
@section('content')
<div class="container">
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Backend Home</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/backend/save') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for title>Home Page</label>
                            <select id="home_page" class="form-control" name="home_page" title="home_page">
                                @foreach ($pages as $page)
                                        <option value="{{$page->id}}" <?=(isset($site->home) && $site->home == $page->id) ? 'selected' : '' ?>>{{$page->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for title>Next Tournament Page</label>
                            <select id="next_tournament_page" class="form-control" name="next_tournament_page" title="home_page">
                                @foreach ($tournaments as $tournament)
                                    <option value="{{$tournament->id}}" <?=(isset($site->next_tournament) && $site->next_tournament == $tournament->id) ? 'selected' : '' ?>>{{$tournament->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for title>Next Tournament Page</label>
                            <select id="previous_tournament_page" class="form-control" name="previous_tournament_page" title="home_page">
                                @foreach ($tournaments as $tournament)
                                    <option value="{{$tournament->id}}" <?=(isset($site->previous_tournament) && $site->previous_tournament == $tournament->id) ? 'selected' : '' ?>>{{$tournament->name}}</option>
                                @endforeach
                            </select>
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
@stop