<!-- 共通部分の切り出し -->
<!-- cardの部分（ユーザ名、Gravatarの画像）、フォロー/アンフォローボタン -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
    </div>
</div>
@include('user_follow.follow_button', ['user' => $user])