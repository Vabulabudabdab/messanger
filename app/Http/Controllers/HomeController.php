<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFriendRequest;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditUserImageRequest;
use App\Http\Requests\SearchFriendRequest;
use App\Models\Friends;
use App\Models\FriendsUsers;
use App\Models\Post;
use App\Models\PostsLikeds;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{

    public function index(User $user)
    {

        $user_posts = Post::where('user_id', $user->id)->get();
        $postLikes = PostsLikeds::where('user_id', $user->id)->get();


        $friends =  FriendsUsers::where('to_user', $user->id)->orWhere('from_user', $user->id)->get();


//        (friend_one="$user_id" OR friend_two="$user_id")
//        AND
//        (friend_one="$friend_id" OR friend_two="$friend_id");

        return view('Home.index', compact('user', 'user_posts', 'postLikes', 'friends'));
    }

    public function friend_requests()
    {

        $check_users = FriendsUsers::where('to_user', auth()->user()->id)->get();

        $users = User::whereIn('id', $check_users->pluck('to_user'))->get();

        return view('home.friends-requests', compact('users'));
    }

    public function search_friends(SearchFriendRequest $request)
    {

        $data = $request->validated();

        $users = $this->userService->searchFriend($data);

        $exists_friend = Friends::where('from_user', auth()->user()->id)->get();

        $exists_requests = FriendsUsers::where('from_user', auth()->user()->id)->get();

        if ($users !== null) {
            return view('home.search-friends', compact('users', 'exists_friend', 'exists_requests'));
        } else {
            return view('home.search-friends');
        }
    }


    public function edit_image(User $user, EditUserImageRequest $request)
    {
        $data = $request->validated();

        $this->userService->changeImage($user, $data);

        return redirect()->back()->with('success_change_avatar', 'Ваш аватар успешно изменён');
    }

    public function add_friend_request(User $user)
    {

        $this->userService->addFriendRequest($user);

        $auth_id = auth()->user()->id;

        return redirect()->route('index.home', $auth_id);
    }

    public function add_friend_request_from_list(User $user)
    {
        $this->userService->addFriendRequestList($user);

        $auth_id = auth()->user()->id;

        return redirect()->route('index.home', $auth_id);
    }

    public function delete_friend_request(User $user)
    {
        $this->userService->deleteFriendRequest($user);

        $auth_id = auth()->user()->id;

        return redirect()->route('index.home', $auth_id);
    }


    public function create_post(CreatePostRequest $request)
    {

        $data = $request->validated();

        $this->userService->createPost($data);

        return redirect()->back();
    }

    public function like_post(Post $post)
    {

        $this->userService->likePost($post);

        return redirect()->back();
    }

}
