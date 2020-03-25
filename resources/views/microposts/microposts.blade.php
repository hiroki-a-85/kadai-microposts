<!-- Bootstrap Media List -->
<ul class="list-unstyled">
    @foreach ($microposts as $micropost)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    <!-- class="text-muted" Bootstrap 文字の色の装飾 -->
                    {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                </div>
                <div>
                    <!--　お気に入りに追加するボタン　-->
                    @if (!Auth::user()->is_adding_into_favorites($micropost->id) && !Auth::user()->is_my_micropost($micropost->id))
                        {!! Form::open(['route' => ['favorites.favorite', $micropost->id], 'method' => 'post']) !!}
                            {!! Form::submit('Favorite', ['class' => 'btn btn-success btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                    
                    <!--　お気に入りから外すボタン　-->
                    @if (Auth::user()->is_adding_into_favorites($micropost->id))
                        {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('UnFavorite', ['class' => 'btn btn-secondary btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                    
                    <!-- micropost削除ボタン -->
                    @if (Auth::id() == $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>

<!-- MicropostsControllerでmicropostsをページネーションして取得した -->
<!-- view側でのBootstrapでのページネーションのリンク -->
{{ $microposts->links('pagination::bootstrap-4') }}