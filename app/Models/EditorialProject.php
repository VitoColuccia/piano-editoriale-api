<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EditorialProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'editorial_projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'pages',
        'price',
        'cost',
        'sector_id',
        'author_id',
        'is_approved_by_ceo',
        'is_approved_by_editorial_director',
        'is_approved_by_editorial_responsible',
        'is_approved_by_sales_director',
    ];

    /************************************************************************************
     * RELATIONSHIPS
     */

    /**
     * Get the author
     *
     * @return HasOne
     */
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * Get the sector
     *
     * @return HasOne
     */
    public function sector(): HasOne
    {
        return $this->hasOne(Sector::class, 'id', 'sector_id');
    }

    /**
     * Get logs
     *
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(EditorialProjectLog::class, 'editorial_project_id');
    }
}
