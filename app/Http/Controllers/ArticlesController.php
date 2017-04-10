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

class ArticlesController extends Controller
{
    /**
     * @param Request $request
     * @return $this
     */
    public function getArticlesList()
    {
        $articles = Articles::orderBy('id','desc')->paginate(3);
        Log::info($articles);
        foreach($articles as $article){
            $article->image = Storage::url('/articles/'.$article->id.'.png');
            if(!$article->image){
                $article->image = Storage::url('/articles/default.png');
            }
            $article->created_by = User::select('full_name')->where('id',$article->created_by)->first();
        }
//        Log::info($article);
        return view('articles.articles_list')->with(['articles'=> $articles]);

    }

    /**
     * @param $id
     * @return $this
     */
    public function getArticleDetail($id)
    {
        $article = Articles::where('id',$id) ->first();
        $article->image = Storage::url('/articles/'.$article->id.'.png');
        if(!$article->image){
            $article->image = Storage::url('/articles/default.png');
        }
        $others = Articles::where('id','<',$id)->limit(4)->get();
       /* $others = Articles::orderBy('created_at','desc')->limit(4)->get();*/
        /*$article->created_by = User::select('full_name')->where('id',$article->created_by)->first();*/
/*        $others = Articles::where('id','<>',$id);*/

        return view('articles.article_detail')->with([
            'article' => $article,
            'others' => $others
        ]);

    }

    public function postArticle(Request $request){
        $title = $request['title'];
        $content = $request['content'];
        $article = new Articles();
        $article->title = $title;
        $article->content = $content;
        $article->save();
        return redirect()->back();

    }
}
