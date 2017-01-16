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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                            <label for="address2" class="col-md-4 control-label">Address Line 1</label>

                            <div class="col-md-6">
                                <input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}" required>

                                @if ($errors->has('address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                            <label for="address2" class="col-md-4 control-label">Address Line 2</label>

                            <div class="col-md-6">
                                <input id="address2" type="text" class="form-control" name="address2" value="{{ old('address1') }}">

                                @if ($errors->has('address2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('prov') ? ' has-error' : '' }}">
                            <label for="prov" class="col-md-4 control-label">Prov</label>

                            <div class="col-md-6">
                                <select id="prov" class="form-control" name="prov" required>
                                    @foreach ($provs as $prov)
                                        <option value="{{$prov}}" <?=(old('prov') == $prov)? 'selected' : ''?>>{{$prov}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('prov'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prov') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('postal') ? ' has-error' : '' }}">
                            <label for="postal" class="col-md-4 control-label">Postal Code</label>

                            <div class="col-md-6">
                                <input id="postal" type="string" class="form-control" name="postal" value="{{ old('postal') }}" required>

                                @if ($errors->has('postal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cfc_number') ? ' has-error' : '' }}">
                            <label for="cfc_number" class="col-md-4 control-label">CFC Number</label>

                            <div class="col-md-6">
                                <input id="cfc_number" type="number" class="form-control" name="cfc_number" value="{{ old('cfc_number') }}" min="0" required>

                                @if ($errors->has('cfc_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cfc_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                            <label for="rating" class="col-md-4 control-label">Rating</label>

                            <div class="col-md-6">
                                <input id="rating" type="number" class="form-control" name="rating" value="{{ old('rating') }}" min="0" max="2900" required>

                                @if ($errors->has('rating'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age" class="col-md-4 control-label">Age Group</label>
                            <div class="col-md-6">
                                <select id="age" class="form-control" name="age" required>
                                    <option value="Adult" <?=(old('age') == 'Adult')? 'selected' : ''?>>Adult</option>
                                    <option value="Junior" <?=(old('age') == 'Junior')? 'selected' : ''?>>Junior</option>
                                    <option value="VIU Student" <?=(old('age') == 'VIU Student')? 'selected' : ''?>>VIU Student</option>
                                </select>
                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <input type="hidden" name="cfc_expiry_date" value="<?=date("Y-m-d H:i:s")?>">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
