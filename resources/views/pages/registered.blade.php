@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Registered Players for {{$tournament->name}}</div>
                    <div class="panel-body" style="overflow-x:auto;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Player Name</th>
                                <th>CFC Number</th>
                                <th>CFC Expiry Date</th>
                                <th>Rating</th>
                                <th>Province</th>
                                <th>Registration Date</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $player = null; ?>
                            @foreach ($players as $p)
                                <?php if(Auth::id() == $p['player']->id) $player = $p['player']; ?>
                                <tr <?=Auth::id() == $p['player']->id ? 'class="registered"' : ''?> >
                                    <td>{{$p['player']->name}}</td>
                                    <td>{{$p['player']->cfc_number}}</td>
                                    <td>{{$p['player']->cfc_expiry_date}}</td>
                                    <td>{{$p['player']->rating}}</td>
                                    <td>{{$p['player']->prov}}</td>
                                    <td>{{$p['registration_date']}}</td>
                                    <td>
                                        @if(Auth::id() == $p['player']->id)
                                            <a class="btn btn-primary" href="/tournament/withdraw/{{$tournament->id}}">Withdraw from this tournament</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::check() && Auth::user()->isAdmin)
                                            <a class="btn btn-primary" href="/tournament/player_details/{{$tournament->id}}/{{$p['player']->id}}">Player Details</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if (!$registered)
                           <a class="btn btn-primary" href="/tournament/registration_form/{{$tournament->id}}">Register for this tournament</a>
                        @endif
                        @if ($registered && !($player->tournaments()->find($tournament->id)->pivot->paid))
                            <div class="well well-sm col-sm-12">
                                <p>
                                    Thank you for registering for this tournament. Payment is due on registration. Any players
                                who have not completed a payment option by the end of the early bird period will lose the discount. If
                                    payment is not received by the end of the on site registration you will not be paired in the first round.

                                    You may pay with interact email transfer to {{Config::get('constants._SITE_EMAIL')}}  or with PayPal using the link below.
                                </p>
                            </div>
                            @if(Auth::user()->age == 'Adult')
                                <a class="btn btn-primary" href="https://www.paypal.me/nanaimoopen/<?=($tournament->early_reg_end > date("Y-m-d H:i:s") ? $tournament->early_ef : $tournament->full_ef)?>">Pay using PayPal</a>
                            @elseif(Auth::user()->age == 'Junior' || Auth::user()->age == 'VIU Student')
                                <a class="btn btn-primary" href="https://www.paypal.me/nanaimoopen/<?=($tournament->early_reg_end > date("Y-m-d H:i:s") ?
                                    $tournament->early_ef - $tournament->junior_discount : $tournament->full_ef - $tournament->junior_discount )?>">Pay using PayPal</a>
                            @endif
                        @endif
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection