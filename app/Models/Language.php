<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function translations()
    {
        return $this->hasMany(PostTranslation::class, 'language_id', 'id');
    }
}
