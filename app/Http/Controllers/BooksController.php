<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    //本の一覧表示画面(=index)
    public function index()
    {
        //
        $books = Book::orderBy('created_at','asc')->get();
        return view('books',[
                'books' => $books
        ]);
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
     
    //一般的にweb上での登録はstoreで行う
    public function store(Request $request)
    {
        //
        //バリデーション
    $validator = Validator::make($request->all(), [
        'item_name' => 'required|max:255',
    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
    return redirect('/')
    ->withInput()
    ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）
    $books = new Book;
    $books->item_name = $request->item_name;
    $books->item_number = '1';
    $books->item_amount = '1000';
    $books->published = '2017-03-07 00:00:00';
    $books->save();
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
    public function edit(Book $book)
    {
        //
        return view('booksedit', ['book' => $book]);
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
        'item_name' => 'required|max:255',
    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    // Eloquent モデル
    $books = Book::find($request->id);
    $books->item_name = $request->item_name;
    $books->item_number = '1';
    $books->item_amount = '1000';
    $books->published = '2017-03-07 00:00:00';
    $books->save(); 
    return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    //削除のコントローラは、destroy
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return redirect('/');
    }
}
