@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Log in</h1>
    </div>

    <div class="row">
        
        <!-- col-sm-6 --!>
        <!-- ウインドウ幅がsm（スマートフォン＝576px）以上のときに6カラム分の幅を使用 --!>
        <!-- ウインドウ幅がそれ未満のときは通常のdivの挙動となり横幅100%を使用 -->
        
        <!-- offset-sm-3 -->
        <!-- ウインドウ幅がsm（スマートフォン＝576px）以上のときに3カラム分のすき間を直前に挿入 --!>
        <!-- ウインドウ幅がそれ未満のときはすき間は空かない -->
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                <!-- Create block level buttons—those that span the full width of a parent—by adding .btn-block. -->
                {!! Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

            <p class="mt-2">New user? {!! link_to_route('signup.get', 'Sign up now!') !!}</p>
        </div>
    </div>
@endsection