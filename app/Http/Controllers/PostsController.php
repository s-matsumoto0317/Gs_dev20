<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //この行を上に追加（投稿）
use App\User;//この行を上に追加（ユーザー）
use App\Check;
use Auth;//この行を上に追加（ログイン）
use Validator;//この行を上に追加（バリデーション）


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //全ての投稿データを取得
        $posts = Post::get();
        
        
        $result = config('const.check_item');
        
        if (Auth::check()) {
             //ログインユーザーのお気に入りを取得
            $favo_posts = Auth::user()->favo_posts()->get();
             
        
            
             
             return view('posts',[
            'posts'=> $posts,
            'favo_posts'=>$favo_posts,
            'result'=>$result,
            ]);
            
        }else{
            
            return view('posts',[
            'posts'=> $posts,
            'result'=>$result,
            ]);
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $check_items = config('const.check_item');
        
        
        
        return view('postsnew', [
            'check_items' => $check_items,
        ]);
        
    }
    
    
    public function process(Request $request)
    {
        $request->validate([
            'post_desc'       => 'required',
            'check_item' => 'required',
        ]);

        $input = $request->except('submit');

        try {
            DB::beginTransaction();

            // postsテーブルにデータを格納
            $posts = new Post();
            $posts->fill($input);
            $posts->save();

            // postsのidを $postId とする
            $postId = $post->id;

            // 登録されたチェックボックスの内容を配列で所持
            $postData = $request->get('check_item');

            // checksテーブルにデータを格納
            foreach ($postData as $post) {
                $entryCheck = new Check();
                $entryCheck->posts_id = $postId;
                $entryCheck->check_item   = $post;
                $entryCheck->save();
            }

            DB::commit();

            return redirect()->route('/');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('post')->withInput($input)->with('flash_message', 'エラーが発生しました。');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーション 
        $validator = Validator::make($request->all(), [
            'post_desc' => 'required|max:255',
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $posts = new Post;
        $posts->post_desc = $request->post_desc;
        $posts->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $posts->save();
        
        // inquirersのidを $inquiryId とする
            $postId = $posts->id;

            // 登録されたチェックボックスの内容を配列で所持
            $postData = $request->get('check_item');

            if(count($postData) >'numeric |between:1,3'){
            
                //バリデーションに引っかかったときの対応を書く
                
                echo'エラーが発生しました。';
                
            }


            // checksテーブルにデータを格納
            foreach ($postData as $post) {
                $entryCheck = new Check();
                $entryCheck->posts_id = $postId;
                $entryCheck->check_item   = $post;
                $entryCheck->save();
            }
        
        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //更新画面のcontrollerはedit
    public function edit(Request $request)
    {
        
        
        
        $check_items = config('const.check_item');
        $check = Post::find(1)->checks;
        
        if (Auth::check()) {
             //ログインユーザーのお気に入りを取得
            
            $favo_posts = Auth::user()->favo_posts()->get();
            $post = Post::find($request->id);
            $result = config('const.check_item');
            
            $checks = [];
            foreach($post->checks as $check){
            array_push($checks , $check->check_item);
            }
            
             
             return view('postsedit',[
            'post'=> $post,
            'favo_posts'=>$favo_posts,
            'result'=>$result,
            'check_items' => $check_items,
            'checks'=>$checks
            ]);
            
        }else{
            
            return view('postsedit',[
            'post'=> $post
            ]);
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //更新処理のcontrollerはupdate
    public function update(Request $request)
    {
        //
         //バリデーション
    $validator = Validator::make($request->all(), [
        'post_desc' => 'required|max:255',
    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    // Eloquent モデル
    $posts = Post::find($request->id);
    $posts->post_desc = $request->post_desc;
    $posts->user_id = '1';
    $posts->save(); 
    
    // inquirersのidを $inquiryId とする
            $postId = $posts->id;

            Check::where("posts_id" ,$posts->id)->delete();
            

            // 登録されたチェックボックスの内容を配列で所持
            $postData = $request->get('check_item');

            // checksテーブルにデータを格納
            foreach ($postData as $post) {
                $entryCheck = new Check();
                $entryCheck->posts_id = $postId;
                $entryCheck->check_item   = $post;
                $entryCheck->save();
            }
        
    
    return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect('/');
    }
    
    //いいね処理
    
    public function favo($post_id){
        
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //いいねする記事
        $post = Post::find($post_id);
        
        //リレーションの登録
        $post->favo_user()->attach($user);
        
        return redirect('/');

    }

}
