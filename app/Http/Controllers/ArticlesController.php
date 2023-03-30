<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Articles::with('category')->where('user_id',auth()->id())->get();
        return view('admin.articles.index',[
            'articles' => $article
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.articles.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:png,jpg,gif,svg,jpeg|max:2048',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $img = $request->file('image');
        $imgName = $img->hashName();
        $img->storeAs('public/images/article/',$imgName);

        Articles::create([
            'title' => $request->title,
            'image' => $imgName,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth()->id(),
        ]);

        return redirect()->route('articles.index')->with('success','Data sudah ditambahkan');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function show(Articles $articles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function edit(Articles $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articles $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articles $articles)
    {
        //
    }


    //API
    public function listAll(){
        $data = Articles::all();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $data,
        ]);
    }
    public function createAPI(Request $request){
        $data = Validator::make($request->all(),[
            'title' => 'required',
            'image' => 'required|image|mimes:png,jpg,gif,svg,jpeg|max:2048',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        if ($data->fails()){
            return response()->json($data->errors());
        }

        $img = $request->file('image');
        $imgName = $img->hashName();
        $img->storeAs('public/images/article/',$imgName);

        $result = Articles::create([
            'title' => $request->title,
            'image' => $imgName,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth()->id(),
        ]);
        return response()->json([
            'success' => true,
            'message' => "Article Berhasil Dibuat",
            'data' => $result
        ]);
    }

    public function showAPI($id){
        $data = Articles::find($id);
        if (!$data){
            return response()->json([
                'message' => 'Data tidak dapat ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $data,
        ]);
    }

    public function updateAPI(Request $request, $id){

        $articles = Articles::find($id);
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors(),
                'result' => $request->all()
            ]);
        }

        if ($request->hasFile('image') && $request->category_id){
            $img = $request->file('image');
            $imgName = $img->hashName();
            $img->storeAs('public/images/article/',$imgName);
            Storage::delete('public/images/article',$articles->image);

            $articles->update([
                'title' => $request->title,
                'image' => $imgName,
                'content' => $request->content,
                'category_id' => $request->category_id
            ]);
        }
        else if($request->hasFile('image')){
            $img = $request->file('image');
            $imgName = $img->hashName();
            $img->storeAs('public/images/article/',$imgName);
            Storage::delete('public/images/article',$articles->image);

            $articles->update([
                'title' => $request->title,
                'image' => $imgName,
                'content' => $request->content,
            ]);
        }else{
            $articles->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengupdate data',
            'data' => $articles,
        ]);

    }

    public function deleteAPI($id){
        $article = Articles::find($id);
        Storage::delete('public/images/articles/'. $article->image);
        $article->delete();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data',
        ]);
    }
}
