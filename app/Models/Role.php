<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    const ROLE_EDITORIAL_DESIGN_MANAGER = 'editorial-design-managers';
    const ROLE_EDITORIAL_RESPONSIBLE = 'editorial-responsibles';
    const ROLE_EDITORIAL_DIRECTOR = 'editorial-directors';
    const ROLE_SALES_DIRECTOR = 'sales-directors';
    const ROLE_CEO = 'ceos';
    const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'key',
        'description',
    ];

    protected $table = 'roles';

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}
