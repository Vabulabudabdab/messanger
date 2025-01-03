<?php

namespace App\Http\Service;

use App\Models\Friends;
use App\Models\FriendsUsers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserService
{

    /**
     * @param User $user
     * @param $data
     * @return void
     */
    public function changeImage(User $user, $data)
    {

        $image = $this->getImagePath($data['image']);
        $this->deleteOldImage($user);
        try {

            $user->update([
                'image' => $image
            ]);

        } catch (\Exception $exception) {
            dd($exception);
        }

    }

    public function createPost($data)
    {

        $post_name = $data['post_name'];
        $image = $this->getImagePath($data['image']);
        $post_text = $data['text'];

        try {

            $post = Post::create([
                'post_name' => $post_name,
                'image' => $image,
                'text' => $post_text,
                'to_user' => auth()->user()->id
            ]);

            $post->relatedUsers()->attach(auth()->user()->id);

        } catch (\Exception $exception) {
            dd($exception);
        }

    }

    /**
     * @param $user
     * @return void
     */
    public function deleteOldImage($user)
    {

        $old_image = $user->where('id', $user->id)->first('image');

        if (!empty($old_image->image) != null) {
            $file_delete = Storage::disk('public')->delete('/images', $old_image->image);
        }


    }

    /**
     * @param $image
     * @return bool
     */
    public function getImagePath($image)
    {

        $file_path = Storage::disk('public')->put('/images', $image);

        return $file_path;
    }

    public function likePost(Post $post)
    {
        $result = auth()->user()->likedPosts()->toggle($post->id);
    }

    public function searchFriend($data)
    {

        if (!empty($data['user_name'])) {

            $user_name = $data['user_name'];

            $users = User::where('name', 'LIKE', "%{$user_name}%")->get();

            if ($users->count() >= 1) {

                return $users;
            } else {
                $response = Session::put('not_found_user', 'Пользователь не найден');

                return $response;
            }

        } else {
            $response = Session::put('not_found_user', 'Пользователь не найден');
        }

    }

    public function addFriendRequest(User $user)
    {

        $check_request_friend = FriendsUsers::where([
            ['to_user', $user->id],
            ['from_user', auth()->user()->id]

        ])->first();

        if ($check_request_friend == null) {
            try {
                DB::beginTransaction();


                $result = FriendsUsers::create([
                    'to_user' => $user->id,
                    'from_user' => auth()->user()->id,
                    'status' => 2
                ]);

//            $result = auth()->user()->friends()->toggle($post->id);

                DB::commit();
            } catch (\Exception $exception) {
                dd($exception);
                DB::rollBack();
            }
        } else {
            Session::put('request_exists', 'Вы уже отправили заявку этому пользователю');
        }

    }

    public function addFriendRequestList(User $user)
    {

            try {
                DB::beginTransaction();

                $check_request_friend = FriendsUsers::where('to_user', $user->id)
                    ->orWhere('from_user', $user->id)->update([
                        'status' => 1
                    ]);



                DB::commit();
            } catch (\Exception $exception) {
                dd($exception);
                DB::rollBack();
            }
        }

    public function deleteFriendRequest(User $user)
    {
        $check_request_friend = FriendsUsers::where('to_user', $user->id,)->delete();

    }

}
