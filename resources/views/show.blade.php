@extends('layouts.home')


@section('content')
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <img src="{{asset('storage/images/article' . $articles->image)}}" alt="" srcset="">
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container" style="height: 590px">
    <div class="col-lg-16" >
        <h2>{{ $articles->title }} - {{ $articles->category->name }}</h2>
        <p>{{ $articles->content }}</p>
        <a class="btn btn-primary mb-2" href="{{url('/')}}">Back</a>
    </div>
</div>
@endsection
