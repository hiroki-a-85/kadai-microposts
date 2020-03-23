@if (count($users) > 0)

    <!-- Bootstrap Media List -->
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                
                <!-- Gravatar、Gravatarに登録したemailで設定した画像を呼び出す、第2引数でpxを指定 -->
                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        <p>{!! link_to_route('users.show', 'View profile', ['id' => $user->id]) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    
    <!-- ページネーション(View側の記述) -->
    <!-- Bootstrap4を利用したページネーションのリンクの表示はこの記述の仕方になる -->
    {{ $users->links('pagination::bootstrap-4') }}
@endif