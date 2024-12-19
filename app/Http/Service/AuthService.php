<?php

namespace App\Http\Service;

use App\Jobs\CreateUserJob;
use App\Jobs\SendPasswordRestoreJob;
use App\Jobs\SendPasswordRestoreToUserJob;
use App\Mail\SendRestorePasswordMail;
use App\Models\RestorePassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class AuthService
{

    /**
     * @param $data
     * @return void
     */
    public function register_post($data)
    {

        try {

            $name = $data['name'];
            $email = $data['email'];
            $hashed_password = $data['password'];

            DB::beginTransaction();

            $user = User::create([
                'name' => $email,
                'email' => $email,
                'password' => $hashed_password
            ]);

            Auth::login($user);

            CreateUserJob::dispatch($user);

            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollback();
        }


    }

    /**
     * @param $data
     * @return bool
     */
    public function login_post($data)
    {

        $result = Auth::attempt($data);

        return $result;
    }

    /**
     * @param $data
     * @return void
     */
    public function restore_password($data)
    {

        $email = $data['email'];

        $user_id = User::where('email', $email)->first('id')->id;

        $time = Carbon::now()->addHour(3);

        $parse_time = Carbon::parse($time)->format('h:m:s');

        $uuid = Str::uuid()->toString();

        try {

            $token = RestorePassword::create([
                'uuid' => $uuid,
                'user_id' => $user_id,
                'expired' => $parse_time
            ]);

            $send_token = $token->uuid;

            $user = User::where('email', $email)->update([
                'restore_pass_token' => $token->uuid
            ]);

            Mail::to($email)->send(new SendRestorePasswordMail($email, $send_token, $user_id));

//            SendPasswordRestoreToUserJob::dispatch($email, $send_token); not work

        } catch (\Exception $exception) {
            dd($exception);
            abort(500);
        }

    }

    /**
     * @param $token
     * @param $user_id
     * @param $data
     * @return void
     */
    public function change_password_token_request($token, $user_id, $data)
    {

        $user = User::where('id', $user_id)->first();

        $hashed_password = Hash::make($data['password']);

        $count = 1;

        try {

            DB::beginTransaction();

            $result = $user->update([
                'password' => $hashed_password,
                'restore_pass_token' => null
            ]);

            $tokens = RestorePassword::where('user_id', $user_id)->get();
            $count_exists_token_for_user = RestorePassword::where('user_id', $user_id)->count();

            DB::table('users')
                ->where('restore_pass_token', $token)
                ->update(['restore_pass_token' => null]);

            foreach ($tokens as $item_delete) {
                $count++;
                $deletedRows = RestorePassword::where('user_id', '=', $count)->delete();
            }


            DB::commit();

        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
        }
    }

}
