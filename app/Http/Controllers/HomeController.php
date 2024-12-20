<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditUserImageRequest;
use App\Models\Post;
use App\Models\User;

class HomeController extends BaseController {

    public function index(User $user) {

        $user_posts = Post::where('user_id', $user->id)->get();

        return view('Home.index', compact('user', 'user_posts'));
    }

    public function edit_image(User $user,EditUserImageRequest $request)
    {
        $data = $request->validated();

        $this->userService->changeImage($user, $data);

        return redirect()->back()->with('success_change_avatar', 'Ваш аватар успешно изменён');
    }

    public function create_post(CreatePostRequest $request) {

        $data = $request->validated();

        $this->userService->createPost($data);

        return redirect()->back();
    }

    public function like_post(Post $post) {

        $this->userService->likePost($post);

        return redirect()->back();
    }

}
