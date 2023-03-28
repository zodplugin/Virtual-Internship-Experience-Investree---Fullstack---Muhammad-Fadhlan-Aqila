<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function createAPI(Request $request){
        $request['user_id'] = 1;
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
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'success' => true,
            'message' => "Article Berhasil Dibuat",
            'data' => $result
        ]);
    }
}
