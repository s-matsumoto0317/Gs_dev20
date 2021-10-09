<!-- resources/views/posts.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- 全ての投稿リスト -->
     @if (count($posts) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>投稿一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <!-- 投稿日時 -->
                                <td class="table-time">
                                    <div>{{ $post->created_at }}</div>
                                </td>
                                 <!-- 投稿詳細 -->
                                <td class="table-text">
                                    <div>{{ $post->post_desc }}</div>
                                </td>
                                
                                <td class="table-text">
                                    
                                 @foreach ($post->checks as $check)
                                 
                                    <div>{{ $result[$check->check_item] }}</div>
                                 @endforeach
                                </td>
                                <!-- 投稿更新ボタン -->
                                 <td>
                                 	<form action="{{ url('postsedit/'.$post->id) }}" method="GET">
                                    {{ csrf_field() }}
                                 	 <button type="submit" class="btn btn-primary">
                                 	  編集 
                                 	</button>
                                 	</form>
                                 </td>
                                <td>
                        　<!-- 投稿削除ボタン -->
             			         <form action="{{ url('post/'.$post->id) }}" method="POST">
                                 {{ csrf_field() }}
                                 {{ method_field('DELETE') }}
                                 <button type="submit" class="btn btn-danger">
                                     削除
                                 </button>
                                 </form>
                                 </td>
 				　　　　　　<!-- いいねボタン -->
                                <td class="table-text">
                                @if(Auth::check())
                                	@if(Auth::id() != $post->user_id && $post->favo_user()->where('user_id',Auth::id())->exists() !== true)
                                	<form action="{{ url('post/'.$post->id) }}" method="POST">
                                		{{ csrf_field() }}
                                		<button type="submit" class="btn btn-danger">
                                		いいね
                                		</button>
                                	</form>
                                	@endif
                                @endif
                                </td>
                            <!-- 投稿者名の表示 -->
                                <td class="table-text">
                                <div>{{ $post->user->name }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>		
    @endif
    
    @if( Auth::check() )
    
        @if (count($favo_posts) > 0)
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <th>いいね一覧</th>
                            <th>&nbsp;</th>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody>
                            @foreach ($favo_posts as $favo_post)
                                <tr>
                                    <!-- 投稿タイトル -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->post_title }}</div>
                                    </td>
                                     <!-- 投稿詳細 -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->post_desc }}</div>
                                    </td>
                                    <!-- 投稿者名の表示 -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->user->name }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>		
        @endif
　　@endif
@endsection