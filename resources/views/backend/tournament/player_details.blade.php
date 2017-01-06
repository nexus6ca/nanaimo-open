@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$result['user']->name}}'s Details for {{$result['tournament']->name}}</div>
                    <div class="panel-body">
                        <form name="edit" action="/backend/tournament/update_player/{{$result['tournament']->id}}/{{$player->user_id}}" method="post">
                            <div class="form-group col-md-6">
                                <label for="title">Byes Requested</label>
                                <div class="col-md-8">
                                    <label class="checkbox">
                                        <input type="checkbox" name="byes[]" value="1" <?=(substr($player->pivot->byes, '1') ? 'selected' : '')?>>Round 1 Sat. 10:00am
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="byes[]" value="2" <?=(substr($player->pivot->byes, '2') ? 'selected' : '')?>> Round 2 Sat. 2:30pm
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="byes[]" value="3" <?=(substr($player->pivot->byes, '3') ? 'selected' : '')?>>Round 3 Sat. 6:00pm
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="byes[]" value="4" <?=(substr($player->pivot->byes, '4') ? 'selected' : '')?>>Round 4 Sun. 10:00am
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="byes[]" value="5" <?=(substr($player->pivot->byes, '5') ? 'selected' : '')?>>Round 5 Sun. 2:30
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="paid" >Paid?</label>
                                <input name="paid" type="radio" value="1" <?=($player->pivot->paid ?'checked=checked' : '')?>>Yes</input>
                                <input name="paid" type="radio" value="0" <?=(!($player->pivot->paid) ?'checked=checked' : '')?>>No</input>
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