@extends('layouts.default')
@section('content')
    <?php session()->put('url.intended', URL::previous()); ?>
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Tournament Information</div>
                    <div class="panel-body">
                        <?=$tournament->details?>
                        @if ($active == 'next_tournament')
                                <a class="btn btn-primary" href="/registered/{{$tournament->id}}">Tournament Registration</a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop