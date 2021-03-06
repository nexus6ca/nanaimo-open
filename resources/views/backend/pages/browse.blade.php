@extends('layouts.default')
@section('content')

    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Browse Pages</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Page Title</th>
                                <th>Last Update</th>
                                <th>Author</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($result as $page)
                                <tr>
                                    <td>{{$page->title}}</td>
                                    <td>{{$page->updated_at}}</td>
                                    <td>{{\App\User::find($page->poster)->name}}</td>
                                    <td><a class="btn btn-primary" href="/backend/pages/edit/{{$page->id}}">Edit</a>
                                    </td>
                                    <td><a class="btn btn-primary delete" id="delete"
                                           href="/backend/pages/delete/{{$page->id}}">Delete</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-primary" id="add" href="/backend/pages/add">Add Page</a>

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



