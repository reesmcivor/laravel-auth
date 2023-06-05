<?php

namespace ReesMcIvor\Auth\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRoles
{
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }
}
