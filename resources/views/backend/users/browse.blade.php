@extends('layouts.default')
@section('content')

    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Browse Users</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Is Admin</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><?=($user->isAdmin)?'<span class="glyphicon glyphicon-king"></span>' : '<span class="glyphicon glyphicon-pawn"></span>'?></td>
                                    <td><a class="btn btn-primary" href="/backend/users/edit/{{$user->id}}">Edit</a>
                                    </td>
                                    <td><a class="btn btn-primary delete" id="delete"
                                           href="/backend/users/delete/{{$user->id}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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