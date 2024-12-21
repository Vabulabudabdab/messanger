@extends('layout.home')

@section('content')

    <div class="content">

        <div class="left-panel">
            <div class="left-panel-item">
                <a href="{{route('index.home', $user->id)}}" class="left-panel-item">Профиль</a>
            </div>
            <div class="left-panel-item">
                Мессенджер
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
            <form action="{{route('index.profile.create.post')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="name-post-create">
                    <div class="post-create-text">Название вашего поста:</div>
                    <input type="text" class="input-user" id="post_name_create" name="post_name">
                </div>

                <div class="img-post-create">
                    <div class="post-create-text">Изображение поста(не обязательно)</div>
                    <input type="file" class="input-user" name="image">
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
        @foreach($user_posts as $post)
            <div class="user_posts">
                <div class="user_post_image">
                    <img src="{{asset('storage/' . $user->image)}}" class="profile-img-post">
                    <div class="post-user-name">{{$post->user->name}}</div>
                </div>
                <div class="post_profile_name">
                    {{$post->post_name}}
                </div>
                <div class="post_image">
                    <img src="{{asset('storage/' . $post->image)}}" class="post_profile_image">
                </div>
                <div class="post_text">
                    {{$post->text}}
                </div>
                <div class="post-like-comments">
                    <form action="{{route('index.profile.post.like', $post->id)}}"
                          id="post-like" method="post" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" style="background: none; border: 0px;">
                            @if(\App\Models\PostsLikeds::where('post_id', $post->id)->count() >= 1)
                                <img src="{{asset('assets/heart-fill.svg')}}" class="red-fill">
                            @else
                                <img src="{{asset('assets/heart.svg')}}" class="red-fill">
                            @endif
                        </button>
                    </form>
                    @foreach($postLikes as $like)
                        @if($like->post_id == $post->id)
                            <div class="like_count">{{\App\Models\PostsLikeds::where('post_id', $post->id)->count()}}</div>
                        @endif
                    @endforeach


                </div>
            </div>
        @endforeach
        {{--end user posts--}}
    </div>

@endsection
