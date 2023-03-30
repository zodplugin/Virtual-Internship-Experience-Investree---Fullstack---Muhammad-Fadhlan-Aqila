@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <h2>Tambah Artikel</h2>
    <br>
    <form action={{route('articles.update', $article->id)}} method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value={{Auth()->id()}}>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="{{$article->title}}">
        </div>
        <div class="mb-3">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Category</label>
                <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                    @foreach ($categories as $category)
                    @if($category->id === $loop->iteration)
                        <option value={{$category->id}} selected>{{$category->name}}</option>
                    @endif
                    <option value={{$category->id}}>{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
        </div>
        <div class="mb-3">
            <div class="form-group">
                <label for="exampleFormControlFile1">Image</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                <img src={{asset('storage/images/article/'. $article->image)}} alt="" srcset="" width="200px">
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content">{{ $article->content }}</textarea>
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection
