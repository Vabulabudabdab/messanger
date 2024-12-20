<?php

namespace App\Http\Service;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService {

    public function changeImage(User $user, $data) {

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

    public function deleteOldImage($user) {

        $old_image = $user->where('id', $user->id)->first('image');

        $file_delete = Storage::disk('public')->delete('/images', $old_image->image);

    }

    public function getImagePath($image) {

        $file_path = Storage::disk('public')->put('/images', $image);

        return $file_path;
    }

}
