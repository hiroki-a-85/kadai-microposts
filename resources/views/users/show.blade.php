@extends('layouts.app')

@section('content')

    <!-- 一つのrowの中で、col-[カラム数]が合計〜12になるよう各要素に割り当てる -->
    <div class="row">
        
        <!-- aside要素は補足、脚注などを表すセクションに対して使用する -->
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            
            @include('users.navtabs', ['user' => $user])
            
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