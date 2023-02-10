<?php

namespace App\Repositories\User;

use App\Constant\Constanst;
use App\Jobs\JobMail;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\BaseRepository;
use DateTime;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface {

    public function getModel()
    {
        return User::class;
    }

    public function getAllUser()
    {
        return $this->model->where('deleted_at', null)->where('is_active', Constanst::ACTIVE)->get();
    }

    public function getUser($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['username', 'created_at', 'id'];
        $data = $this->model->with(['getProfile'])
        ->where('deleted_at', null)->where('is_active', Constanst::ACTIVE)->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns),sortOrder())->paginate($paginate);
        return $result;
    }

    public function insertUser($req)
    {
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

        $create_account = new $this->model();
        $create_account->fill($req->all());
        $create_account->password = Hash::make($req->password);
        $create_account->is_active = Constanst::ACTIVE;
        $create_account->profile_id = $create_profile->id;
        $create_account->remember_token = ' ';
        $create_account->save();

        $role = $req->role?$req->role:Constanst::ROLE_USER;
        $create_account->user_role()->attach($role);

        $data = [
            "account"=>$create_account,
            "profile"=>$create_profile
        ];

        return $data;
    }

    
    public function updateUser($req, $id)
    {
        $user = $this->model->findOrFail($id);
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

    public function deleteUser($id)
    {
        $datetime = new DateTime();
        $user = $this->softDelete($id);
        $user->getProfile()->update([
            'deleted_at' => $datetime->format('Y-m-d H:i:s')
        ]);
    }
}