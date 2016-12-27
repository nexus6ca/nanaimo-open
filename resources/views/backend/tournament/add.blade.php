@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Tournament</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/backend/tournament/save') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Tournament Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label for="start_date" class="col-md-4 control-label">Start Date</label>

                                <div class="col-md-6">
                                    <input id="start_date" type="date" class="form-control" name="start_date"
                                           value="{{ old('start_date') }}" required>

                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                <label for="end_date" class="col-md-4 control-label">End Date</label>

                                <div class="col-md-6">
                                    <input id="end_date" type="date" class="form-control" name="end_date"
                                           value="{{ old('end_date') }}" required>

                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('early_reg_end') ? ' has-error' : '' }}">
                                <label for="early_reg_end" class="col-md-4 control-label">Early Bird End Date</label>

                                <div class="col-md-6">
                                    <input id="early_reg_end" type="date" class="form-control" name="early_reg_end"
                                           value="{{ old('early_reg_end') }}">

                                    @if ($errors->has('early_reg_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('early_reg_end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="page_data">Page Data</label>
                                <textarea class="form-control" name="details" rows="5"></textarea>
                            </div>
                            <div class="col-md-6 col-md-offset-4">
                                <input type="hidden" name="category" value="tournament">
                                <input type="hidden" name="completed" value="0">
                                <button type="submit" class="btn btn-primary">
                                    Add Tournament
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection