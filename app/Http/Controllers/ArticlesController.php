<?php
/**
 * Created by PhpStorm.
 * User: TramNguyen
 */

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use DB;
class ArticlesController extends Controller
{
    /**
     * @param Request $request
     * @return $this
     */
    public function getArticlesList()
    {
        $articles = Articles::orderBy('id','desc')->paginate(6);
//        Log::info($articles);
        foreach($articles as $article){
            if(Storage::exists('public/articles/'.$article->id.'.png'))
                $article->image = Storage::url('/articles/'.$article->id.'.png');
            else
                $article->image = Storage::url('/articles/default.png');
            $article->created_by = User::select('full_name')->where('id',$article->created_by)->first();
        }
        /*Log::info($article);*/
        return view('articles.articles_list')->with(['articles'=> $articles]);
    }

    /**
     * @param $id
     * @return $this
     */
    public function getArticleDetail($id)
    {
        $article = Articles::find($id);

        if(Storage::exists('public/articles/'.$article->id.'.png'))
            $article->image = Storage::url('/articles/'.$article->id.'.png');
        else
            $article->image = Storage::url('/articles/default.png');

        $others = Articles::where('id','<',$id)->limit(4)->get();

        return view('articles.article_detail')->with([
            'article' => $article,
            'others' => $others
        ]);

    }

    public function addArticle(Request $request){
        $article = new Articles;
        $article->title = $request['title'];
        $article->content = $request['content'];
        $article->created_by = Auth::user()->id;
        $maxID = DB::table('INFORMATION_SCHEMA.TABLES')
            ->where('table_name', '=', 'articles')
            ->pluck('auto_increment');
        $maxID = $maxID[0];
        if($request->hasFile('image_article')){
            $image = $request->file('image_article');
            Storage::put('/public/articles/'.$maxID.'.png', file_get_contents($image->getRealPath()));
        }
        $article->save();
        $message = ['message_success'=>'Post article successfully!'];
        return redirect()->back()->with($message);
    }

    public function getEditArticle($id)
    {
        $article = Articles::find($id);
        $article->image = Storage::url('/articles/'.$article->id.'.png');
        if(!$article->image){
            $article->image = Storage::url('/articles/default.png');
        }
        return view('articles.edit_article')->with(['article' => $article]);
    }

    public function updateArticle(Request $request){
        $article = Articles::find($request['id']);
        $article->title = $request['title'];
        $article->content = $request['content'];
        if($request->hasFile('image_article')){
            Log::info('has file');
            $image = $request->file('image_article');
            Storage::put('/public/articles/'.$request['id'].'.png', file_get_contents($image->getRealPath()));
        }
        $article->save();
        $message = ['message_success'=>'Update article successfully!'];
        return redirect()->route('article-detail',['id' => $article->id])->with($message);
    }

    public function deleteArticle(Request $request){

        $article = Articles::find($request['article_id']);
        $article->delete();
        return 1000;
    }
}

