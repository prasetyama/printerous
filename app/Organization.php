<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
	protected $table = 'organizations';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
