@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
    　@if( Auth::check() )　<!--ログインしているユーザーしか表示させないためのコード-->
        <form action="{{ url('posts') }}" method="POST">
            <!-- post_desc -->
            <div class="form-group">
                <label for="post_desc">内省投稿</label>
                <textarea type="text" name="post_desc" class="form-control" value=""></textarea>
            </div>
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">選択（3つまで選択可）</p>
                <div class="col-sm-8">
                    @foreach ($check_items as $key => $check_item)
                        <label>
                            <input type="checkbox" value="{{ $key }}" name="check_item[]">
                            {{ $check_item }}</label>
                    @endforeach
                </div>
            </div>
            <!-- post_desc -->
            <!-- 投稿 ボタン/戻る ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">投稿</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}"> 戻る</a>
            </div>
            <!-- 投稿 ボタン/戻る ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    　@endif   <!--ログインしているユーザーしか表示させないためのコード--> 
    </div>
</div>
@endsection