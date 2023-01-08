<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Profile;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;

class UserService {

    public function getAllUser () {
        return User::with('getProfile')->where('deleted_at', null)->get();
    }

    public function getPaginateUser ($paginate = 10) {
        return  User::with('getProfile')->where('deleted_at', null)->paginate($paginate);
    }

     public function insertUser ($req) {
        $dataImage = checkIssetImage($req, [
            'image'=>'avatar',
            'prefixName'=>'user',
            'folder'=>'uploads/users',
            'imageOld'=>''
        ]);
        $create_profile = new Profile();
        $create_profile->fill($req->all());
        $create_profile->avatar = $dataImage;
        $create_profile->save();

        $create_account = new User();
        $create_account->fill($req->all());
        $create_account->password = Hash::make($req->password);
        $create_account->is_active = 1;
        $create_account->profile_id = $create_profile->id;
        $create_account->remember_token = ' ';
        $create_account->save();

        $create_account->user_role()->attach($req->role);
    }

    public function updateUser ($req, $id) {
        $user = User::findOrFail($id);
        $user->fill($req->all());
        $user->update();

        $profile = Profile::findOrFail($req->profile_id);
        $profile->fill($req->all());
        $dataImage = checkIssetImage($req, [
            'image'=>'avatar',
            'prefixName'=>'user',
            'folder'=>'uploads/users',
            'imageOld'=>''
        ]);
        $profile->avatar = $dataImage;
        $profile->update();

        $user->user_role()->sync($req->role);
    }

    public function deleteUser ($id) {
        $user = User::findOrFail($id);
        $datetime = new DateTime();
        $user->deleted_at = $datetime->format('Y-m-d H:i:s');
        $user->update();
    }


}
