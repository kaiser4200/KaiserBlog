@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Edit Post</h3>
                <div class="card">
                    <div class="card-header">
                        <form action="{{route('post.update',['id'=>$editpost->id])}}" method="POST"  enctype="multipart/form-data">
                            @csrf @method('PUT')

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="edittitle">Title</label>
                                    <input type="text" class="form-control" id="edittitle" name="edittitle" placeholder="{{$editpost->title}}" value="{{$editpost->title}}">
                                </div>

                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="editdescription">Description</label>
                                    <textarea type="text" class="form-control" id="editdescription" name="editdescription" placeholder="{$editpost->description}}" height="500">{!!$editpost->description!!}</textarea>
                                </div>

                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="editimage">Image</label>
                                    <img class="rounded-circle" style="width: 30%;" src="{{asset($editpost->image)}}" alt="">
                                    {{--<a href="{{route('img_delete',['id'=>$editpost->id])}}" class="" >--}}
                                        {{--<button type="button" class="btn btn-danger btn-sm">Remove image & set default</button>--}}
                                    {{--</a>--}}

                                    {{--@if($editpost->image === 'image/blog_post/default_blog_img/default.jpg')--}}

                                        <input type="file" class="form-control" id="image" name="image">



                                </div>

                            </div>

                            <div class="card-footer">
                                <a href="{{url()->previous()}}">
                                <button type="button" class="btn btn-secondary">Back</button></a>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
