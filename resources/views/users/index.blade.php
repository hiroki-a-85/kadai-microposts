@extends('layouts.app')

@section('content')

    <!-- view()関数と同じように第２引数に連想配列の形で渡す値を指定できる -->
    @include('users.users', ['users' => $users])
@endsection