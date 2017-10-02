@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit {{$tournament->name}}</div>
                    <div class="panel-body">
                        <form name="edit" action="/backend/tournament/save/{{$tournament->id}}" method="post">
                            <div class="form-group">
                                <label for="title">Tournament Name</label>
                                <input class="form-control" name="name" type="text" value="{{$tournament->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for ="start_date">Start Date</label>
                                <input class="form-control" name="start_date" type="date" value="{{$tournament->start_date}}" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input class="form-control" name="end_date" type="date" value="{{$tournament->end_date}}" required>
                            </div>
                            <div class="form-group">
                                <label for="early_reg_end">Early Bird Registration End Date</label>
                                <input class="form-control" name="early_reg_end" type="date" value="{{$tournament->early_reg_end}}" required>
                            </div>
                            <div class="form-group">
                                <label for="early_reg_end">Early Bird Entry Fee</label>
                                <input class="form-control" name="early_ef" type="number" value="{{$tournament->early_ef}}" required>
                            </div>
                            <div class="form-group">
                                <label for="early_reg_end">Full Entry Fee</label>
                                <input class="form-control" name="full_ef" type="number" value="{{$tournament->full_ef}}" required>
                            </div>
                            <div class="form-group">
                                <label for="early_reg_end">Junior Discount</label>
                                <input class="form-control" name="junior_discount" type="number" value="{{$tournament->junior_discount}}" required>
                            </div>
                            <div class="form-group">
                                <label for="completed" >Completed</label>
                                <input name="completed" type="radio" value="1" <?=($tournament->completed)?'checked=checked' : ''?>>Yes</input>
                                <input name="completed" type="radio" value="0" <?=(!$tournament->completed)?'checked=checked' : ''?>>No</input>
                            </div>
                            <div class="form-group">
                                <div class="tabs">
                                    <ul class="tab-links" style="padding:0px; margin-bottom: 5px">
                                        <li class="active"><a href="#details">Details</a></li>
                                        <li><a href="#crosstable">Crosstable</a></li>
                                        <li><a href="#pairings">Pairings</a></li>
                                        <li><a href="#report">Report</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab active" id="details">
                                        <label for="entry">Tournament Details</label>
                                        <textarea class="form-control" name="details">{{$tournament->details}}</textarea>
                                    </div>
                                    <div class="tab" id="crosstable">
                                        <label for="crosstable">Crosstable</label>
                                        <textarea class="form-control" name="crosstable">{{$tournament->crosstable}}</textarea>
                                    </div>
                                    <div class="tab" id="pairings">
                                        <label for="pairings">Pairings</label>
                                        <textarea class="form-control" name="pairings">{{$tournament->pairings}}</textarea>
                                    </div>
                                    <div class="tab" id="report">
                                        <label for="report">Report</label>
                                        <textarea class="form-control" name="report"> {{$tournament->report}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Save " class="button">
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
                        </form>
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