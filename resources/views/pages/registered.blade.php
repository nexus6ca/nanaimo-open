@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Registered Players for {{$tournament->name}}</div>
                    <div class="panel-body">
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($players as $p)
                                <tr <?=Auth::id() == $p['player']->id ? 'class="registered"' : ''?> >
                                    <td>{{$p['player']->name}}</td>
                                    <td>{{$p['player']->cfc_number}}</td>
                                    <td>{{$p['player']->cfc_expiry_date}}</td>
                                    <td>{{$p['player']->rating}}</td>
                                    <td>{{$p['player']->prov}}</td>
                                    <td>{{$p['player']->created_at}}</td>
                                    <td>
                                        @if($registered)
                                            <a class="btn btn-primary" href="/tournament/withdraw/{{$tournament->id}}">Withdraw from this tournament</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                           <a class="btn btn-primary <?=($registered && Auth::check()) ? 'hidden':''?>" href="/tournament/registration_form/{{$tournament->id}}">Register for this tournament</a>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection