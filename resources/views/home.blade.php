@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">


            <div class="col-md-12">

                <h3>Dashboard</h3>
                <div class="card">
                    <div class="card-header">
                        <ul class="list-inline">
                            <li class="list-inline-item float-right">
                                <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#addPost"> + Post </button>

                            </li>
                            <li class="list-inline-item">
                                {{$post->links()}}
                            </li>
                        </ul>
                    </div>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="post">

                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="10%">Image</th>
                                <th scope="col" width="10%">Title</th>
                                <th scope="col">Post</th>
                                <th scope="col" width="15%">Date</th>
                                <th scope="col" width="20%">Action</th>
                            </tr>
                            </thead>

                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($post as $value)

                            <tr>
                                <th scope="row">{{$i++}}</th>

                                <td><img class="rounded-circle" style="width: 100%;" src="{{asset($value->image)}}" alt=""> </td>

                                <td>
                                    <a href="{{route('post.show',['id'=>$value->id])}}">{{$value->title}}</a></td>

                                <td>{{str_limit($value->description,200)}}</td>

                                <td>{{$value->created_at->diffForHumans()}}</td>

                                <td class="row">
                                <a href="{{route('post.edit',['id'=>$value->id])}}">
                                    <button class=" btn btn-sm btn-danger " data-toggle="modal" data-target="#editPost">Edit</button>
                                </a>
                                <form action="{{route('post.destroy',['id'=>$value->id])}}" method="post">
                                    @csrf @method('delete')
                                    <button class=" btn btn-sm btn-danger ml-2">Delete</button>
                                </form>
                                </td>

                            </tr>


                        @endforeach
                        </tbody>
                        </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Add title">
                        </div>

                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Add description"></textarea>
                        </div>

                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    {{--<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<h5 class="modal-title" id="exampleModalLabel">Add new Post</h5>--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}

                {{--<form action="{{route('post.update',['id'=>$editpost->id])}}" method="POST" enctype="multipart/form-data">--}}
                    {{--@csrf--}}

                    {{--<div class="modal-body">--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="edittitle">Title</label>--}}
                            {{--<input type="text" class="form-control" id="edittitle" name="edittitle" placeholder="{{$editpost->title}}">--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="modal-body">--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="editdescription">Description</label>--}}
                            {{--<input type="text" class="form-control" id="editdescription" name="editdescription" placeholder="{{$editpost->description}}">--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="modal-body">--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="editimage">Image</label>--}}
                            {{--<img class="rounded-circle" style="width: 30%;" src="{{asset($value->image)}}" alt="">--}}
                            {{--<input type="file" class="form-control" id="editimage" name="editimage">--}}
                        {{--</div>--}}

                    {{--</div>--}}

                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        {{--<button type="submit" class="btn btn-primary">Save changes</button>--}}
                    {{--</div>--}}

                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
