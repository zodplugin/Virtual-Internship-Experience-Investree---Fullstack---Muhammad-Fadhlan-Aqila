<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Articles::with(['category','user'])->get();
        return view('admin.index',[
            'article' => $articles->first(),
            'articles' => $articles
        ]);
    }

    public function welcome(){
        $articles = Articles::with(['category','user'])->paginate(4);
        return view('welcome',[
            'articles' => $articles
        ]);
    }

    public function show($id){
        $data = Articles::with('category')->findOrFail($id);
        return view('show',[
            'articles' => $data
        ]);
    }
}
