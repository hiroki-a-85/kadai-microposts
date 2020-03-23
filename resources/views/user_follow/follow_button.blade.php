<!-- フォロー／アンフォローボタンを表示する部分の共通のView -->

<!-- users/show.blade.phpの中に設置-->
<!-- ある特定の一つのユーザの詳細画面-->

<!-- Auth::id() ログイン中のユーザのidが、今アクセスしているユーザの詳細画面のidと異なる時に表示される -->
@if (Auth::id() != $user->id)
    
    <!-- ログイン中のユーザ情報の中から、is_followingメソッドで今アクセスしているユーザのidがあるかどうか -->
    <!-- 有る（フォローしている）：unfollow -->
    <!-- 無い（フォローしていない）：follow -->
    @if (Auth::user()->is_following($user->id))
        {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfollow', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
            {!! Form::submit('Follow', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif