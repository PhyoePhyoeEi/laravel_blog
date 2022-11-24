<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;

class ArticleController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index(){
        $data = Article::latest()->paginate(5);
        return view('article.index', [
            'articles' => $data
        ]);
    }

    public function detail($id){
        $data = Article::find($id);
        return view('article.detail', [
            'article' => $data,
        ]);
    }

    public function add(){
        $category = Category::all();
        return view('article.add', [
            'categories' => $category
        ]);
    }


    public function create(){
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $article = new Article;

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');

    }
    public function edit($id){
        $article = Article::find($id);
        $category = Category::all();
        return view('article.edit', [
            'article' => $article,
            'categories' => $category
        ]);
    }

    public function update($id){
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect("/articles/detail/$article->id");
    }

    public function delete($id){
        $article = Article::find($id);
        if(Gate::allows('article_delete', $article)){
            $article->delete();
            return redirect("/articles")->with("info", "Delete Successful");
        } else {
            return redirect("/articles")->with('error', 'Unauthorize');
        }

    }

}
