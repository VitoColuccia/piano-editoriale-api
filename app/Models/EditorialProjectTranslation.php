<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EditorialProjectTranslation extends Model
{
    use HasFactory, SoftDeletes;

    /************************************************************************************
     * CONSTANTS
     */
    const FIELD_TITLE = 'TITLE';
    const FIELD_DESCRIPTION = 'DESCRIPTION';
    const FIELD_PERMALINK = 'PERMALINK';

    protected $table = 'editorial_project_translations';

    protected $fillable = [
        'id',
        'field',
        'locale',
        'text',
    ];
}
