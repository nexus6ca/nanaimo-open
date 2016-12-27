@extends('layouts.default')
@section('content')
    <?php
    $provs = array('BC', 'AB', 'SK', 'MB', 'ON', 'QC', 'NB', 'PE', 'NS', 'NF', 'YK', 'NT', 'NU');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/profile/save/'. $user->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $user->name }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ $user->email }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address2" class="col-md-4 control-label">Address Line 1</label>
                                <div class="col-md-6">
                                    <input id="address1" type="text" class="form-control" name="address1"
                                           value="{{ $user->address1 }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address2" class="col-md-4 control-label">Address Line 2</label>
                                <div class="col-md-6">
                                    <input id="address2" type="text" class="form-control" name="address2"
                                           value="{{ $user->address2 }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-md-4 control-label">City</label>
                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city"
                                           value="{{ $user->city }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="prov" class="col-md-4 control-label">Prov</label>
                                <div class="col-md-6">
                                    <select id="prov" class="form-control" name="prov" required>
                                        @foreach ($provs as $prov)
                                            <option value="{{$prov}}" <?=($user->prov == $prov) ? 'selected' : ''?>>{{$prov}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="postal" class="col-md-4 control-label">Postal Code</label>
                                <div class="col-md-6">
                                    <input id="city" type="postal" class="form-control" name="postal"
                                           value="{{ $user->postal }}" required>
                                </div>
                            </div>
                            @if(Auth::user()->isAdmin)
                                <div class="form-group">
                                    <label for="isAdmin" class="col-md-4 control-label">Is Admin</label>
                                    <div class="col-md-6">
                                        <input name="isAdmin" type="radio"
                                               value="1" <?=($user->isAdmin) ? 'checked=checked' : ''?>>Yes</input>
                                        <input name="isAdmin" type="radio"
                                               value="0" <?=(!$user->isAdmin) ? 'checked=checked' : ''?>>No</input>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a class="btn btn-primary" id="back" href="{{ URL::previous() }}">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop