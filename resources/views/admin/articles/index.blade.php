@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <a href={{route('articles.create')}} class="btn btn-primary mb-5"><i class="fas fa fa-plus"></i>&nbsp;&nbsp;Tambah Article</a>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <table class="table table-bordered table-responsive">
            <thead class="table-primary">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col" width="500px">Content</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th width="300px">Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->content }}</td>
                        <td>{{ $article->category->name}}</td>
                        <td><img src={{asset('storage/images/article/'. $article->image)}} alt="" srcset="" width='200px'></td>
                        <td>
                            <form action={{route('articles.destroy', $article->id)}} action="POST">
                                <a href={{route('articles.show', $article->id)}} class="btn btn-primary"><i class="fas fa fa-eye"></i></a>
                                <a href={{route('articles.edit', $article->id)}} class="btn btn-warning"><i class="fas fa fa-pen"></i> </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"> <i class="fas fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
          </table>
    </div>
</div>
@endsection
