<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $appends = ['new_username'];

    protected $fillable = [
        'username',
        'password',
        'is_active',
        'profile_id',
        'remember_token',
        'deleted_at'
    ];


    // get profile
    public function getProfile () {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    //
    public function user_role () {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }


    // check permission
    public function checkPermission ($pmsKey) {
        $roles = Auth::guard('web')->user()->user_role;
        foreach($roles as $role){
            if($role->permission_role->contains('pms_key', $pmsKey)){
               return true;
            }
        }
        return false;
    }

    // // get new
    // public function getNewUsernameAttribute () {
    //     return $this->username . '_111';
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'remember_token',
        'profile_id',
        'is_active',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function checkRole () {

    // }
}
