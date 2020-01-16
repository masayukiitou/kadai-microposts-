<ul class="list-unstyled">
    @foreach ($favorites as $favorite)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($favorite->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $favorite->user->name, ['id' => $favorite->user->id]) !!} <span class="text-muted">posted at {{ $favorite->created_at }}</span>
                </div>
                <div>

                    <p class="mb-0">{!! nl2br(e($favorite->content)) !!}</p>
                        <div>
                            {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                                {!! Form::submit('unFavorite', ['class' => 'btn btn-success btn-sm']) !!}
                            {!! Form::close() !!}
                            @if (Auth::id() == $favorite->user_id)
                                {!! Form::open(['route' => ['microposts.destroy', $favorite->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>

