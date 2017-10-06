@extends('layouts.default')
@section('content')
    <?php
    $provs = array('BC', 'AB', 'SK', 'MB', 'ON', 'QC', 'NB', 'PE', 'NS', 'NF', 'YK', 'NT', 'NU');
    session()->put('url.intended', URL::previous());
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
                                <label for="cfc_number" class="col-md-4 control-label">CFC Number</label>

                                <div class="col-md-6">
                                    <input id="cfc_number" type="number" class="form-control" name="cfc_number" value="{{ $user->cfc_number }}" min="0" required>
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="age" class="col-md-4 control-label">Age Group</label>

                                <div class="col-md-6">
                                    <select id="age" class="form-control" name="age" required>
                                        <option value="Adult" <?=($user->age == 'Adult')? 'selected' : ''?>>Adult</option>
                                        <option value="Junior" <?=($user->age == 'Junior')? 'selected' : ''?>>Junior</option>
                                        <option value="VIU Student" <?=($user->age == 'VIU Student')? 'selected' : ''?>>VIU Student</option>
                                    </select>
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