@extends('layouts.default')
@section('content')

    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Backend Home</div>
                    <div class="panel-body">
                    <div class="col-md-4 col-md-offset-0">
                        <div>
                            <div class="well well-sm" style="margin-bottom: 2px">Setup Site Pages to user created pages in the database. If no pages created go to create page first.</div>
                            <a class="btn btn-primary" href="/backend/manage_site/">Manage Site</a>
                        </div>
                        <div style="margin-top: 3px">
                            <div class="well well-sm" style="margin-bottom: 2px">Create and Manage User defined pages here.</div>
                            <a class="btn btn-primary" href="/backend/pages/browse">Manage Pages</a>
                        </div>
                        <div style="margin-top: 2px">
                            <div class="well well-sm" style="margin-bottom: 2px">Create and Manage Tournaments Here</div>
                            <a class="btn btn-primary" href="/backend/tournament/browse">Manage Tournaments</a>
                        </div>
                        <div style="margin-top: 2px">
                            <div class="well well-sm" style="margin-bottom: 2px">Manage Users Here - new users are created through the sign up.</div>
                            <a class="btn btn-primary" href="/backend/users/browse">Manage Tournaments</a>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-0">
                        <div class="well well-sm"><label>Number of Pages Created</label> {{$pages->count()}}</div>
                        <div class="well well-sm"><label>Number of Tournaments Created</label> {{$tournaments->count()}}</div>
                        <div class="well well-sm"><label>Number of User Created</label> {{$users->count()}}</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop