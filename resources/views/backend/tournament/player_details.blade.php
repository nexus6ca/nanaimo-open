@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$player->name}}'s Details for {{$tournament->name}}</div>
                    <div class="panel-body">
                        <form name="edit" action="/backend/tournament/update_player/{{$tournament->id}}/{{$player->id}}" method="post">
                            <div class="form-group">
                                <label for="title">Byes Requested</label>
                                <div id="bye-list">
                                    <div class="checkboxes">
                                        <label class="checkbox">
                                            <input type="checkbox" name="byes[]" value="1" <?=(strpos($player->pivot->byes, '1')!== false ? 'checked' : '')?>>Round 1 Sat. 10:00am
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="byes[]" value="2" <?=(strpos($player->pivot->byes, '2') !== false ? 'checked' : '')?>> Round 2 Sat. 2:30pm
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="byes[]" value="3" <?=(strpos($player->pivot->byes, '3') !== false ? 'checked' : '')?>>Round 3 Sat. 6:00pm
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="byes[]" value="4" <?=(strpos($player->pivot->byes, '4') !== false ? 'checked' : '')?>>Round 4 Sun. 10:00am
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="byes[]" value="5" <?=(strpos($player->pivot->byes, '5') !== false ? 'checked' : '')?>>Round 5 Sun. 2:30
                                        </label>
                                    </div>
                                </div>
                                <label for="paid" >Paid?</label>
                                <input name="paid" type="radio" value="1" <?=($player->pivot->paid ?'checked=checked' : '')?>>Yes</input>
                                <input name="paid" type="radio" value="0" <?=(!($player->pivot->paid) ?'checked=checked' : '')?>>No</input>
                            </div>

                            <input type="submit" value="Save " class="button btn btn-primary">
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
                        </form>
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-primary delete" href="/backend/tournament/remove_player/{{$tournament->id}}/{{$player->id}}">Remove Player</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".delete").on("click", function () {
            return confirm("Do you want to delete this item?");
        });
    </script>
@stop