@extends('layouts.app')

@section('content')

    <!-- 一つのrowの中で、col-[カラム数]が合計〜12になるよう各要素に割り当てる -->
    <div class="row">
        
        <!-- aside要素は補足、脚注などを表すセクションに対して使用する -->
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    
                    <!-- bootstrap _rounded:角を丸める -->
                    <!-- bootstrap_img-fluid:画像の大きさがレスポンシブ対応になる -->
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            
            <!-- nav-justified:両端揃え、nav nav-tabs:タブ・メニュー化 -->
            <ul class="nav nav-tabs nav-justified mb-3">
                
                                            <!-- users.showへのURLを生成-->
                <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">TimeLine <span class="badge badge-secondary">{{ $count_microposts }}</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link">Followings</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Followers</a></li>
            </ul>
            
            <!-- micropostの投稿フォーム -->
            @if (Auth::id() == $user->id)
                {!! Form::open(['route' => 'microposts.store']) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            @endif
            @if (count($microposts) > 0)
                @include('microposts.microposts', ['microposts' => $microposts])
            @endif
        </div>
    </div>
@endsection