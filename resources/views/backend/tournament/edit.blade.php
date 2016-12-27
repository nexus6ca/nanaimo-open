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
                                <label for="completed" >Completed</label>
                                <input name="completed" type="radio" value="1" <?=($tournament->completed)?'checked=checked' : ''?>>Yes</input>
                                <input name="completed" type="radio" value="0" <?=(!$tournament->completed)?'checked=checked' : ''?>>No</input>
                            </div>
                            <div class="form-group">
                                <label for="entry">Tournament Details</label>
                                <textarea class="form-control" name="details">{{$tournament->details}}</textarea>
                            </div>
                            <input type="submit" value="Save " class="button">
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop