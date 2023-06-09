<?php

namespace ReesMcIvor\Auth\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ReesMcIvor\Auth\Database\Factories\RoleFactory;

class TenantUser extends Model
{
    protected $fillable = ['tenant_id', 'user_id', 'email'];

    public function tenant() : BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
