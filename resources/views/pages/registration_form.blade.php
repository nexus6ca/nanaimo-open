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
                                {{Auth::user()->name}}
                            </p>
                            <p>
                                <label for="cfc_number" class="col-md-4 control-label">CFC Number</label>
                                {{Auth::user()->rating}}
                            </p>
                            <p>
                                <label for="rating" class="col-md-4 control-label">Rating</label>
                                {{Auth::user()->rating}}
                            </p>
                            <p>
                                <label for="address1" class="col-md-4 control-label">Address Line 1</label>
                                {{Auth::user()->address1}}
                            </p>
                            @if(Auth::user()->address2 != null)
                            <p>
                                <label for="address2" class="col-md-4 control-label">Address Line 2</label>
                                {{Auth::user()->address2}}
                            </p>
                            @endif
                            <p>
                                <label for="city" class="col-md-4 control-label">City</label>
                                {{Auth::user()->city}}
                            </p>
                            <p>
                                <label for="prov" class="col-md-4 control-label">Province</label>
                                {{Auth::user()->prov}}
                            </p>
                            <p>
                                <label for="postal" class="col-md-4 control-label">Postal Code</label>
                                {{Auth::user()->prov}}
                            </p>
                        </div>
                        <div class="well well-sm">
                            Please update your information above if incorrect.
                        </div>
                        <a class="btn btn-primary" href="/profile/display">Update Proile</a>

                        <form class="form-horizontal" role="form" method="POST" action="/tournament/register/<?=$tournament->id?>">
                            {{ csrf_field() }}
                            <div class="form-group">

                                <div>
                                    <div class="well well-sm col-md-4">Select the rounds you wish to request a bye. 1/2 point
                                        byes area available in rounds 1-4 and 0 point bye in round 5.
                                    </div>
                                    <div class="controls col-md-8" style="padding-left: 25px">
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
                                </div>
                            </div>

                            <div class="col-md-6 col-md-offset-4">
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