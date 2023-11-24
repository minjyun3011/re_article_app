<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = article::all();
        return view('articles/index', ['articles' => $articles]);
    }
    public function show($id)
    {
        $article = article::find($id);
        return view('articles/show', ['id' => $id, 'article' => $article]);
    }
    public function create()
    {
        return view('articles/create');
    }
    public function store(ArticleRequest $request)
    {
        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();
        return redirect(route('articles.index'));
    }
    public function edit($id)
    {
        $article = article::find($id);
        return view('articles.edit', ['article' => $article]);
    }
    public function update(ArticleRequest $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'your_field' => 'required|custom_validation_rule',
        ], [], [
            'custom_validation_rule' => __('custom-validation.custom_validation_rule'),
        ]);

        if ($validator->fails()) {
            // バリデーションエラーの場合の処理
            return redirect(route("articles.create"))
                ->withErrors($validator)
                ->withInput();
        }
        // ここはidで探して持ってくる以外はstoreと同じ
        $article = article::find($id);

        // 値の用意
        $article->title = $request->title;
        $article->body = $request->body;

        // 保存
        $article->save();

        // 登録したらindexに戻る
        return redirect(route("articles.index"));
    }

    public function destroy($id)
    {
        $article = article::find($id);
        $article->delete();

        return redirect(route("articles.index"));
    }
}
