@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Tournament Information</div>
                    <div class="panel-body">
                        <?=$tournament->details?>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop