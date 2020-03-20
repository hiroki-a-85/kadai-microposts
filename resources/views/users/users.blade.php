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
                            <?php
                            //  .blade.phpの{!! !!}で囲った変数や関数は、{{ }}とは異なり、
                            //  HTMLのタグがエスケープされない 
                            //  つまり出力される<a>タグがそのまま機能する 
                            //  第３引数でusers/{id}のidパラメータに値を渡している 
                             ?>
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