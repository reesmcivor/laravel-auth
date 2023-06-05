<?php

namespace ReesMcIvor\Auth\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Auth\Database\Factories\RoleFactory;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected static function newFactory()
    {
        return RoleFactory::new();
    }

}
