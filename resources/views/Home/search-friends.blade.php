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

                @if($user->id == auth()->user()->id)
                    {{--Не вывожу пользователя--}}

                    {{--Цикл для проверки друга--}}
                    @foreach($user->friend_exists as $fr_exists)
                        @if($user->id == $fr_exists->friend_id)
                        @else

                        @endif
                    @endforeach

                    {{--Конец цикла--}}
                @else
                    {{--Вывожу пользователя--}}
                    <div class="search_friend_block">

                        <img src="{{asset('storage/'.$user->image)}}" class="search-img-friend">

                        <div class="user-name-search">
                            {{$user->name}}
                            <div class="write_to_user_search">
                                <a href="{{route('index.home', $user->id)}}" id="user-link-srch">Написать</a>
                            </div>
                        </div>
                        {{--Buttons check start--}}
                        @if($user->friends_requests->count() >= 1)
                            @foreach($user->friends_requests as $exists_request)
                                @if($user->id == $exists_request->id)
                                    <form action="{{route('index.add.friend', $user->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn-user" id="logout_button"
                                                style="margin-top: 20px; margin-left: 200px">Добавить
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('index.delete.friend', $user->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn-user" id="logout_button"
                                                style="margin-top: 20px; margin-left: 200px">Отменить заявку
                                        </button>
                                    </form>
                                @endif
                            @endforeach
                        @else
                            <form action="{{route('index.add.friend', $user->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn-user" id="logout_button"
                                        style="margin-top: 20px; margin-left: 200px">Добавить
                                </button>
                            </form>
                        @endif
                        {{--Buttons check end--}}
                    </div>
                @endif

            @endforeach
        @else

            <div class="search_friend_block" style="padding: 20px; text-align: center">
                Пользователь не найден
            </div>

    @endif

@endsection
