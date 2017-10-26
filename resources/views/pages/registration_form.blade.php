@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Registration Form for {{$tournament->name}}</div>
                    <div class="panel-body">
                        <div class="player_info">
                            <p>
                                <label for="name" class="col-md-4 control-label">Player Name</label>
                                {{$player->name}}
                            </p>
                            <p>
                                <label for="cfc_number" class="col-md-4 control-label">CFC Number</label>
                                {{$player->cfc_number}}
                            </p>
                            <p>
                                <label for="rating" class="col-md-4 control-label">Rating</label>
                                {{$player->rating}}
                            </p>
                            <p>
                                <label for="rating" class="col-md-4 control-label">Age Group</label>
                                {{$player->age}}
                            </p>
                            <p>
                                <label for="expiry" class="col-md-4 control-label">Expiry Date</label>
                                {{ $player->cfc_expiry_date }}
                            </p>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <form class="form-horizontal" role="form" method="POST"
                              action="/tournament/register/<?=$tournament->id?>">
                            {{ csrf_field() }}
                            <div>

                                <div class="controls col-md-4" style="padding-left: 25px">
                                    <label class="checkbox">
                                        <input type="checkbox" name="bye[]" value="1">Round 1 Sat. 10:00am
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="bye[]" value="2">Round 2 Sat. 2:30pm
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="bye[]" value="3">Round 3 Sat. 6:00pm
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="bye[]" value="4">Round 4 Sun. 10:00am
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="bye[]" value="5">Round 5 Sun. 2:30
                                    </label>
                                </div>
                                <div class="well well-sm col-md-4">Select the rounds you wish to request a bye. 1/2
                                    point
                                    byes area available in rounds 1-4 and 0 point bye in round 5.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input type="hidden" name="paid" value="0">
                                <button type="submit" class="btn btn-primary">
                                    Register for this tournament.
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    </div>
@endsection