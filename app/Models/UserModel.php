<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserModel extends Model {

	protected $table      = 'user';
	protected $primaryKey = 'usr_id';
	//protected $fillable   = [];
	public $timestamps    = false;
	protected $guarded    = [];
	public $incrementing  = false;

	// Login
	public function scopeLogin($query, $data) {
		return $query->select('*')
                    ->where('usr_email', $data["usr_email"])
                    ->where('usr_pass',  $data["usr_pass"])
                    ->first();
	}

    public function scopeUpdateUser($query, $data, $usr_id) {
        return $query->where('usr_id', $usr_id)->update($data);
	}

	
}