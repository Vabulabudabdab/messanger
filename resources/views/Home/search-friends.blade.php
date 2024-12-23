@extends('layout.home')

@section('content')

    <div class="content-search">

        <div class="left-panel-srch">
            <div class="left-panel-item">
                <a href="{{route('index.home', auth()->user()->id)}}" class="left-panel-item">Профиль</a>
            </div>
            <div class="left-panel-item">
                Мессенджер
            </div>
        </div>


        @if($users->count() >= 1)

            @foreach($users as $user)

                <div class="search_friend_block">

                    <img src="{{asset('storage/'.$user->image)}}" class="search-img-friend">

                    <div class="user-name-search">
                        {{$user->name}}
                        <div class="write_to_user_search">
                            <a href="{{route('index.home', $user->id)}}" id="user-link-srch">Написать</a>
                        </div>
                    </div>

                    <form action="{{route('index.add.friend', $user->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn-user" id="logout_button" style="margin-top: 20px; margin-left: 200px">Добавить</button>
                    </form>

                </div>

            @endforeach

    @else

    @endif

@endsection
