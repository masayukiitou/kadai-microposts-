@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('users.navtabs', ['user' => $user])
            @if (Auth::id() == $user->id)
                {!! Form::open(['route' => 'microposts.store']) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            @endif
            @foreach ($microposts as $micropost)
                <li class="media mb-3">
                    <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
                    <div class="media-body">
                        <div>
                            {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                        </div>
                        <div>
                            <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                        </div>
                        <div>
                            @if (Auth::user()->is_favorites($micropost->id))
                                {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                             
                                    {!! Form::submit('unFavorite', ['class' => 'btn btn-success btn-sm']) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['favorites.favorite', $micropost->id], 'method' => 'favorite']) !!}

                                    {!! Form::submit('Favorite', ['class' => 'btn btn-light btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                            @if (Auth::id() == $micropost->user_id)
                                {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </div>
    </div>
@endsection