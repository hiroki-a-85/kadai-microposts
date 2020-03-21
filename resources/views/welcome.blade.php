@extends('layouts.app')

@section('content')

    <!-- Auth::check() -->
    <!-- ユーザーがログインしているかどうかを調べる関数-->
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="card-body">
                        <img class="rounded img-fluid" src="{{ Gravatar::src(Auth::user()->email, 500) }}" alt="">
                    </div>
                </div>
            </aside>
            <div class="col-sm-8">
                
                <!-- micropost投稿フォーム -->
                <!-- ログイン中のユーザIDが、MicropostsControllerから渡された$userのidを等しい時表示 -->
                @if (Auth::id() == $user->id)
                    {!! Form::open(['route' => 'microposts.store']) !!}
                        <div class="form-group">
                            {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                            {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    {!! Form::close() !!}
                @endif
                
                <!-- ログイン中のユーザのmicropostsがある時、views/microposts/microposts.blade.phpを表示 -->
                @if (count($microposts) > 0)
                    @include('microposts.microposts', ['microposts' => $microposts])
                @endif
                
            </div>
        </div>
    @else
        <!-- jumbotronと指定するとメインページの見出しテキスト用CSSが適用される -->
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                
                                                                            <!-- btn-lg:大きめのボタンにする -->
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection