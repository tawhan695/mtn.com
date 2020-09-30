<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
    //else{
            return false;
        // }
    }
    // สาขา
    public function branch(){
        return $this->belongsToMany('App\Branch');
    }
    public function user_branch(){
        return $this->branch()->first()->name;
    }
    public function user_branch_id(){
        return $this->branch()->first()->id;
    }

    public function adminlte_image()
    {
        if($this->image == NULL){
            return 'https://picsum.photos/300/300';
        }else{
            return $this->image;
        }
    }

    public function adminlte_desc()
    {
        // return 'That\'s a nice guy';
        $desc = $this->roles()->first()->name;
        $name = 'null';
        if ($this->roles()->first()->name == 'Manager') {
            # code...
            $name = 'ผู้จัดการ';
        } else if($this->roles()->first()->name == 'BranchManagerAssistant') {
            # code...
            $name = 'ผู้ช่วยผู้จัดการสาขา';
        } else if($this->roles()->first()->name == 'Salesperson') {
            # code...
            $name = 'พนักงานขาย';
        } else if($this->roles()->first()->name == 'DeliveryStaff') {
            # code...
            $name = 'พนักงานส่งของ';
        } else if($this->roles()->first()->name == 'GeneralStaff') {
            # code...
            $name = 'พนักงานทั่วไป';
        }
        
        return  $name ;
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }
}
