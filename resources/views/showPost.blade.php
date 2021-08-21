@extends('layouts.app')

@section('content')


<div class="container">

    <div class="card mb-12 mr-5 ml-5" >
        <div class="card-header">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text"><small class="text-muted">{{$post->created_at->diffForHumans()}}</small></p>
        </div>


        <div class="image"
             style=" height:350px;
                     background: transparent no-repeat top center;
                     background-size: cover;
                     background-image: url('{{asset($post->image)}}'); ">

        </div>

        {{--<img class="card-img-top" height="500px" src="{{asset($post->image)}}" alt="Card image cap">--}}


        <div class="card-body">

            <p class="card-text"> {!!nl2br($post->description)!!}</p>

            @if(Auth::check())
            <a href="{{route('post.edit',['id'=>$post->id])}}">
                <button class=" btn btn-sm btn-danger">Edit</button>
            </a>
            <form action="{{route('post.destroy',['id'=>$post->id])}}" method="post">
                @csrf @method('delete')
                <button class=" btn btn-sm btn-danger">Delete</button>
            </form>
            @endif

        </div>

    </div>

</div>


@endsection
