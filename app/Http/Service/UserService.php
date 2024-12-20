<?php

namespace App\Http\Service;

use App\Models\Post;
use App\Models\User;
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
                'user_id' => auth()->user()->id
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

        $file_delete = Storage::disk('public')->delete('/images', $old_image->image);

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

    public function likePost(Post $post) {
        $result = auth()->user()->likedPosts()->toggle($post->id);
    }

}
