@extends('layouts.default')
@section('content')
<div class="container">

    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Backend Home</div>
                <div class="panel-body">
                    <form style="width:100% !important;" class="form-horizontal" role="form" method="POST" action="{{ url('/backend/save') }}">
                        {{ csrf_field() }}

                        <div class="form-group-lg">
                            <label for title>Site Name</label>
                            <input style="width: 100%" name="site_name" value="<?=isset($site->site_name) ? $site->site_name : '' ?>">
                        </div>
                        <div class="form-group-sm">
                            <label for title>Home Page</label>
                            <select id="home_page" class="form-control" name="home_page" title="home_page">
                                @foreach ($pages as $page)
                                        <option value="{{$page->id}}" <?=(isset($site->home) && $site->home == $page->id) ? 'selected' : '' ?>>{{$page->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group-sm">
                            <label for title>Chess Club Page</label>
                            <select id="chess_club_page" class="form-control" name="chess_club_page" title="home_page">
                                @foreach ($pages as $page)
                                    <option value="{{$page->id}}" <?=(isset($site->club) && $site->club == $page->id) ? 'selected' : '' ?>>{{$page->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group-sm">
                            <label for title>Next Tournament Page</label>
                            <select id="next_tournament_page" class="form-control" name="next_tournament_page" title="home_page">
                                @foreach ($tournaments as $tournament)
                                    <option value="{{$tournament->id}}" <?=(isset($site->next_tournament) && $site->next_tournament == $tournament->id) ? 'selected' : '' ?>>{{$tournament->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group-sm">
                            <label for title>Google Analytics Tag</label>
                            <input style="width: 100%" style="width: 100%" name="google_tag" value="<?=config('constants.GOOGLE_ANALYTICS_KEY')?>">
                            <label for title>Tiny MCE Key</label>
                            <input style="width: 100%" name="tinymce_key" value="{{config('constants.TINY_MCE_KEY')}}">
                        </div>
                        <div class="form-group-sm">
                            <input type="submit" value="Save Page" class="button">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop