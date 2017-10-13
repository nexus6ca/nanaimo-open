@extends('layouts.default')
@section('content')

    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Site Controls</div>
                    <div class="panel-body">
                        <div class="col-md-4 col-md-offset-0">
                            <div>
                                <a class="btn btn-primary btn-block" href="/backend/manage_site/">Manage Site</a>
                            </div>
                            <div style="margin-top: 3px">
                                <a class="btn btn-primary btn-block" href="/backend/pages/browse">Manage Pages</a>
                            </div>
                            <div style="margin-top: 2px">
                                <a class="btn btn-primary btn-block" href="/backend/tournament/browse">Manage Tournaments</a>
                            </div>
                            <div style="margin-top: 2px">
                                <a class="btn btn-primary btn-block" href="/backend/users/browse">Manage Users</a>
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-0">
                            <div class="well well-sm">
                                <h4>Site Stats</h4>
                                <label>Number of Pages Created</label> {{$pages->count()}} <br>
                                <label>Number of TournamentsCreated</label> {{$tournaments->count()}} <br>
                                <label>Number of User Created</label> {{$users->count()}} <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop