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


        @foreach($users as $user)

            <div class="search_friend_block">

                <img src="{{asset('storage/'.$user->image)}}" class="search-img-friend">

                <div class="user-name-search">
                    {{$user->name}}
                    <div class="write_to_user_search">
                        <a href="{{route('index.home', $user->id)}}" id="user-link-srch">Написать</a>
                    </div>
                </div>
                <div class="form-group">
                    <form action="{{route('index.add.friend.request', $user->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn-user" id="friend_request"
                                style="margin-left: 30px; margin-top: 20px;">Принять
                        </button>
                    </form>

                    <form action="{{route('index.delete.request.friend', $user->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn-user" id="friend_request"
                                style="margin-left: 50px; margin-top: 20px;">Отклонить заявку
                        </button>
                    </form>
                </div>


            </div>

        @endforeach

@endsection

