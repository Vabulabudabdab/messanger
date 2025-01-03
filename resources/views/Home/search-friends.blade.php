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


        @if(!empty($users) && $users->count() >= 1)
            @foreach($users as $user)

                {{--Цикл для проверки друга--}}
                @if($user->id == auth()->user()->id)
                    {{--Не вывожу пользователя--}}
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
                @if(!empty($user->friend->to_user) && $user->friend->status == 2)
                            <form action="{{route('delete.friend.request', $user->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn-user" id="logout_button"
                                        style="margin-top: 20px; margin-left: 200px">Отменить заявку
                                </button>
                            </form>
                        @elseif(!empty($user->friend->to_user) && $user->friend->status == 1)

                            <form action="{{route('delete.friend.request', $user->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn-user" id="logout_button"
                                        style="margin-top: 20px; margin-left: 200px">Удалить из друзей
                                </button>
                            </form>
                        @else
                            <form action="{{route('index.add.friend', $user->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn-user" id="logout_button"
                                        style="margin-top: 20px; margin-left: 200px">Добавить в друзья
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
