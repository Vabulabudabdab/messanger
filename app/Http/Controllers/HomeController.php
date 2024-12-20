<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserImageRequest;
use App\Models\User;

class HomeController extends BaseController {

    public function index(User $user) {

        return view('Home.index', compact('user'));

    }

    public function edit_image(User $user,EditUserImageRequest $request)
    {
        $data = $request->validated();

        $this->userService->changeImage($user, $data);

        return redirect()->back()->with('success_change_avatar', 'Ваш аватар успешно изменён');
    }

}
