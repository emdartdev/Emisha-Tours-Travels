<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasTranslations;

class ProfessionType extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'name_bn',
        'slug',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function visaProfessionRequirements(): HasMany
    {
        return $this->hasMany(VisaProfessionRequirement::class);
    }
}
