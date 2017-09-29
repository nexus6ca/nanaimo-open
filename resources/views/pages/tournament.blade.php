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
                            <ul class="tab-links" style="padding:0px; margin-bottom: 5px">
                                <li class="active"><a href="#details">Tournament Information</a></li>
                                <?php if(!empty($tournament->crosstable)){ ?>
                                <li><a href="#crosstable">Crosstable</a></li>
                                <?php } ?>
                                <?php if(!empty($tournament->pairings)) { ?>
                                <li><a href="#pairings">Pairings</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab active" id="details">
                                <?=$tournament->details?>
                            </div>
                            <div class="tab" id="crosstable">
                               <?=$tournament->crosstable?>
                            </div>
                            <div class="tab" id="pairings">
                                <?=$tournament->pairings?>
                            </div>
                            <div class="tab" id="report">
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

    <script>
        $(document).ready(function() {
            $('.tabs .tab-links a').on('click', function(e)  {
                var currentAttrValue = $(this).attr('href');

                // Show/Hide Tabs
                $(currentAttrValue).show().siblings().hide();
                // Change/remove current tab to active
                $(this).parent('li').addClass('active').siblings().removeClass('active');

                e.preventDefault();
            });
        });
    </script>
@stop