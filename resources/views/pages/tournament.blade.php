@extends('layouts.default')
@section('content')
    <?php session()->put('url.intended', URL::previous()); ?>
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Our Next Event
                    </div>
                    <div class="panel-body">
                        <div class="tabs">
                            <ul class="nav nav-tabs" style="padding:0px; margin-bottom: 5px">
                                <li class="active"><a data-toggle="tab" href="#details">Tournament Information</a></li>
                                <?php if(!empty($tournament->crosstable)){ ?>
                                <li><a data-toggle="tab" href="#crosstable">Crosstable</a></li>
                                <?php } ?>
                                <?php if(!empty($tournament->pairings)) { ?>
                                <li><a data-toggle="tab" href="#pairings">Pairings</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="details">
                                <?=$tournament->details?>
                            </div>
                            <div class="tab-pane fade" id="crosstable">
                               <?=$tournament->crosstable?>
                            </div>
                            <div class="tab-pane fade" id="pairings">
                                <?=$tournament->pairings?>
                            </div>
                            <div class="tab-pane fade" id="report">
                                <?=$tournament->report?>
                            </div>
                        </div>
                        @if ($active == 'next_tournament')
                            <a class="btn btn-primary" href="/registered/{{$tournament->id}}">Tournament Registration</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop