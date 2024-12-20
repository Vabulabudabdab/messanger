@extends('layout.home')

@section('content')

    <div class="content">

        <div class="left-panel">
            <div class="left-panel-item">
                <a href="{{route('index.home', $user->id)}}" class="left-panel-item">Профиль</a>
            </div>
            <div class="left-panel-item">
                <a href="" class="left-panel-item">Мессенджер</a>
            </div>
        </div>

        <div class="main-panel">
            <div class="session_response">
                {{session('success_change_avatar')}}
            </div>
            <div class="user-image-block">
                <img src="{{asset('storage/' . $user->image)}}" class="profile-img">
            </div>

            <div class="user-name">
                {{$user->name}}
                <div class="user-desc">
                    {{$user->desc}}132
                </div>

            </div>


            <div class="change-user-info">
                <div class="btn-change-img-profile">
                    <form action="{{route('index.profile.image.edit', auth()->user()->id)}}" method="post"
                          onchange="form_submit()" id="change-img" enctype="multipart/form-data">
                        @csrf
                        <span class="answer-change-profile">Изменить аватар</span>
                        <input type="file" class="input-user" name="image">
                    </form>

                </div>
                <div class="btn-change-info-profile">
                    <button type="submit" class="btn-user">Редактировать профиль</button>
                </div>
            </div>

        </div>

        <div class="create_post" onclick="show_create_post_form()">
            Создать пост
        </div>

        {{--Create post form--}}
        <div class="create_post_show" id="create-post-form">
            <form>
            <div class="name-post-create">
                <div class="post-create-text">Название вашего поста:</div>
                <input type="text" class="input-user" id="post_name_create" name="post_name">
            </div>

            <div class="img-post-create">
                <div class="post-create-text">Изображение поста(не обязательно)</div>
                <input type="file" class="input-user" name="post_image">
            </div>

            <div class="text-post-create">
                <div class="post-create-text">Текст вашего поста(Ограчение в 300 символов):</div>
                <textarea name="text" class="textarea-user" id="post_name_create"></textarea>
            </div>

            <div class="create-post-btn">
                <button class="btn-user" type="submit">Создать пост</button>
            </div>
            </form>
        </div>
        {{-- End create post form--}}

        {{-- user posts--}}
        <div class="user_posts">
            <div class="user_post_image">
                <img src="{{asset('storage/' . $user->image)}}" class="profile-img-post">
                <div class="post-user-name">{{$user->name}}</div>
            </div>
            <div class="post_text">
                I will be a GOD, I will learn all what I can, ALL UNIVERSE WILL FALL BEFORE ME
                I will be a GOD, I will learn all what I can, ALL UNIVERSE WILL FALL BEFORE ME
                I will be a GOD, I will learn all what I
            </div>
            <div class="post-like-comments">
                <img src="{{asset('assets/heart.svg')}}" class="red-fill">
                <div class="like_count">12</div>
                {{--                <img src="{{asset('assets/heart-fill.svg')}}" class="red-fill">--}}
            </div>
        </div>
        {{--end user posts--}}
    </div>

@endsection
