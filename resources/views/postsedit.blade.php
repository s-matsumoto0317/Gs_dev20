@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
        <form action="{{ url('posts/update') }}" method="POST">
            <!-- post_desc -->
            <div class="form-group">
                <label for="post_desc">内省編集</label>
                <textarea name="post_desc" class="form-control">{{$post->post_desc}}</textarea>
            </div>
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">選択（3つまで選択可）</p>
                <div class="col-sm-8">
                    @foreach ($check_items as $key => $check_item)
                    {{$key}}
                      @if(in_array($key,$checks))
                      <label>
                            <input type="checkbox" value="{{ $key }}" name="check_item[]" checked>
                            {{ $check_item }}</label>
                      @else
                        <label>
                            <input type="checkbox" value="{{ $key }}" name="check_item[]">
                            {{ $check_item }}</label>
                      @endif
                    @endforeach
                </div>
            </div>
            <!-- post_desc -->
            <!-- 更新 ボタン/戻る ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">更新</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}"> 戻る</a>
            </div>
            <!-- 更新 ボタン/戻る ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$post->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>
@endsection