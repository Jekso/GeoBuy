<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];

    public function add_new_user($callback_user_info)
    {
        $this->name = $callback_user_info->name ;
        $this->user_id = $callback_user_info->id ;
        $this->avatar = $callback_user_info->avatar ;
        $this->save();
    }


    public function orders()
    {
        return $this->hasMany('App\Order');
    }


    public function save_order($request)
    {
        $this->orders()->create([
            'order_id'  => str_random(32),
            'phone'     => $request->phone,
            'full_addr' => $request->full_addr,
            'location'  => $request->location,
            'amount'    => $request->qty*50
        ]);
    }
}
