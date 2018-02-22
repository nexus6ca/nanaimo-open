<?php
$player = Auth::user();
session()->put('url.intended', URL::current());
?>
@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Registered Players for {!! $tournament->name !!} </div>
                    <div class="panel-body">
                        <div class="panel-group">
                            <?php if(isset($players)) { ?>
                            @foreach ($players as $p)
                                <div class="panel panel-<?=($p['player']->tournaments()->find($tournament->id)->pivot->paid == 0 ? 'danger' : 'default') ?>">
                                    <?php if (Auth::id() == $p['player']->id) $player = $p['player']; ?>
                                    <div class="panel-heading" data-toggle="collapse"
                                         href="#collapse-{{$p['player']->id}}">
                                        <strong> {{$p['player']->name}}</strong>&nbsp<span
                                                class="glyphicon glyphicon-minus"></span>&nbsp{{$p['player']->rating}}
                                    </div>
                                    <div class="panel-collapse collapse" id="collapse-{{$p['player']->id}}">
                                        <ul class="list-group">
                                            <li class="list-group-item"><label>CFC
                                                    Number:&nbsp</label><span>{{$p['player']->cfc_number}}</span></li>
                                            <li class="list-group-item"><label>CFC
                                                    Expiry:&nbsp</label><span>{{$p['player']->cfc_expiry_date}}</span>
                                            </li>
                                            <li class="list-group-item">
                                                <label>Province:&nbsp</label><span>{{$p['player']->prov}}</span></li>
                                            @if ($p['player']->tournaments()->find($tournament->id)->pivot->paid == 0)
                                                <li class="list-group-item list-group-item-danger"><strong>Registration
                                                        Pending Payment</strong></li>
                                            @endif
                                        </ul>
                                        <div class="btn-group">
                                            @if(Auth::id() == $p['player']->id)
                                                <a class="btn btn-danger"
                                                   href="/tournament/withdraw/{{$tournament->id}}">Withdraw from this
                                                    tournament</a>
                                            @endif
                                            @if(Auth::check() && Auth::user()->isAdmin)
                                                <a class="btn btn-primary"
                                                   href="/tournament/player_details/{{$tournament->id}}/{{$p['player']->id}}">Player
                                                    Details</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <?php } ?>
                        </div>
                        @if (!$registered)
                                <!-- Trigger the modal with a button -->
                                {{--<button type="button" class="btn btn-primary" data-toggle="modal"--}}
                                        {{--data-target="#registration">Register for this tournament--}}
                                {{--</button>--}}
                            <span>Email to see if registration will be accepted as we have reached our comfortable max players for the site.</span>
                        @endif
                        @if ($registered && !($player->tournaments()->find($tournament->id)->pivot->paid))
                            <div class="well well-sm col-sm-12">
                                <p>
                                    Thank you for registering for this tournament. Payment is due on registration. Any
                                    players who have not completed a payment option by the end of the early registration
                                    period will be removed from the tournament.

                                    You may pay with interact email transfer to {{Config::get('constants._SITE_EMAIL')}}
                                    or with PayPal using the link below.
                                </p>
                            </div>
                            @if(Auth::user()->age == 'Adult')
                                <a class="btn btn-primary"
                                   href="https://www.paypal.me/nanaimoopen/<?=($tournament->early_reg_end >= date("Y-m-d H:i:s") ? $tournament->early_ef : $tournament->full_ef)?>">Pay
                                    using PayPal</a>
                            @elseif(Auth::user()->age == 'Junior' || Auth::user()->age == 'VIU Student')
                                <a class="btn btn-primary"
                                   href="https://www.paypal.me/nanaimoopen/<?=($tournament->early_reg_end >= date("Y-m-d H:i:s") ?
                                       $tournament->early_ef - $tournament->junior_discount : $tournament->full_ef - $tournament->junior_discount)?>">Pay
                                    using PayPal</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
        <div id="registration" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Registration Form for {{$tournament->name}}</h4>
                    </div>
                    <div class="modal-body">
                        @if(Auth::check())
                        <div class="panel-group panel-default">
                            <div class="panel-heading"><strong>Player Info</strong></div>
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
                                <div class="controls col-md-4"
                                     style="border-top: 1px solid black; border-bottom: 1px solid black;  padding-left: 25px">
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
                                <div class="well well-sm col-md-4 text-info" style="clear: both">Select the rounds you wish to request a bye.
                                    1/2
                                    point
                                    byes area available in rounds 1-4 and 0 point bye in round 5.
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="paid" value="0">
                                </div>
                                <div class="modal-footer" style="clear: both;">
                                    <button type="submit" class="btn btn-primary">
                                       Email nanaimo-open@gmail.com to see if additonal players will be accept
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                        @else
                            @if(Auth::guest())
                                <a href="/login" class="btn btn-info"> You need to login to register.</a>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
@endsection