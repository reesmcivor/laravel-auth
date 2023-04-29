<?php

namespace ReesMcIvor\Auth\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 1;
    const STAFF_ROLE_ID = 2;
    const CUSTOMER_ROLE_ID = 3;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeAdmin($query)
    {
        return $query->where('id', self::ADMIN);
    }

    public function scopeStaff($query)
    {
        return $query->where('id', self::STAFF_ROLE_ID);
    }

    public function scopeCustomer($query)
    {
        return $query->where('id', self::CUSTOMER_ROLE_ID);
    }

}
