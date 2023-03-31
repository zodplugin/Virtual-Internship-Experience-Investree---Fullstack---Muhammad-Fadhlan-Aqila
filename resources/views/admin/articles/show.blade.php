@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <a href="{{route('articles.index')}}">Back</a>
    <div class="row mt-5">
        <div class="col-lg-16">
            <img src="{{asset('storage/images/article/' . $articles->image)}}" alt="">
        </div>
        <div class="col-lg-16">
            <h2 class="mt-4">{{$articles->title}} - {{ $articles->category->name }}</h2>
            <p>{{ $articles->content }}</p>
        </div>
    </div>
</div>
@endsection
