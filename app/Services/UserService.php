<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;

class UserService {

    const USER_ROLE = 2;

    public function getAllUser () {
        return User::with('getProfile')->where('deleted_at', null)->where('is_active', 1)->get();
    }

    public function getPaginateUser ($paginate = 10) {
        return  User::with('getProfile')->where('deleted_at', null)->where('is_active', 1)->paginate($paginate);
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

        $role = $req->role?$req->role:self::USER_ROLE;
        $create_account->user_role()->attach($role);

        $data = [
            "account"=>$create_account,
            "profile"=>$create_profile
        ];
        return $data;
    }

    public function updateUser ($req, $id) {
        $user = User::findOrFail($id);
        $user->fill($req->all());
        $user->update();

        $idProfile = $req->profile_id?$req->profile_id:$user->profile_id;
        $profile = Profile::findOrFail($idProfile);
        $profile->fill($req->all());
        $dataImage = checkIssetImage($req, [
            'image'=>'avatar',
            'prefixName'=>'user',
            'folder'=>'uploads/users',
            'imageOld'=>''
        ]);
        $profile->avatar = $dataImage;
        $profile->update();


        if($req->role){
            $user->user_role()->sync($req->role);
        }

        return $profile;
    }

    public function deleteUser ($id) {
        $user = User::findOrFail($id);
        $datetime = new DateTime();
        $user->deleted_at = $datetime->format('Y-m-d H:i:s');
        $user->update();

        $user->getProfile()->update([
            'deleted_at' => $datetime->format('Y-m-d H:i:s')
        ]);

    }

    public function searchUser ($textSearch){
        $key = trim($textSearch);
        $requestData = ['username'];
        $listUser;
        if($key != ''){
            $listUser = User::with('getProfile')->with('user_role')
            ->where('deleted_at', null)
            ->where(querySearchByColumns($requestData, $key))
            ->paginate(10);
        }else{
            $listUser = $this->getPaginateUser();
        }
        return $listUser;
    }


}
