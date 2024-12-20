@extends('layout.home')

@section('content')

    <div class="content">

        <div class="left-panel">
            <div class="left-panel-item">
                <a href="{{route('index.home')}}" class="left-panel-item">Профиль</a>
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
                <img src="{{asset('storage/' . auth()->user()->image)}}" class="profile-img">
            </div>

            <div class="user-name">
                {{auth()->user()->name}}
                <div class="user-desc">
                    {{auth()->user()->desc}}132
                </div>

            </div>


            <div class="change-user-info">
                <div class="btn-change-img-profile">
                    <form action="{{route('index.profile.image.edit', auth()->user()->id)}}" method="post" onchange="form_submit()" id="change-img" enctype="multipart/form-data">
                        @csrf
                        <span class="answer-change-profile">Изменить аватар</span>
                        <input type="file" class="input-user" name="image" >
                    </form>

                </div>
                <div class="btn-change-info-profile">
                    <button type="submit" class="btn-user">Редактировать профиль</button>
                </div>
            </div>


        </div>

    </div>

@endsection
