@extends('layouts.default')
@section('content')

    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Browse Tournaments</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Tournament Title</th>
                                <th>Last Update</th>
                                <th>Completed</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Early Bird Active</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tournaments as $tournament)
                                <tr>
                                    <td>{{$tournament->name}}</td>
                                    <td>{{$tournament->updated_at}}</td>
                                    <td>{{$tournament->start_date}}</td>
                                    <td>{{$tournament->end_date}}</td>
                                    <td><?=($tournament->early_reg_end < date("Y/m/d"))?'Yes':'No'?></td>
                                    <td><?=($tournament->completed)?'Yes' : 'No'?></td>
                                    <td><a class="btn btn-primary" href="/backend/tournament/edit/{{$tournament->id}}">Edit</a></td>
                                    <td><a class="btn btn-primary delete" id="delete"
                                           href="/backend/tournament/delete/{{$tournament->id}}">Delete</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-primary" id="add" href="/backend/tournament/add">Add Tournament</a>

                        <script>
                            $(".delete").on("click", function () {
                                return confirm("Do you want to delete this item?");
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



