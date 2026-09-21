<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasTranslations;

class VisaProfessionRequirement extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'visa_type_id',
        'profession_type_id',
        'title',
        'title_bn',
        'description',
        'description_bn',
        'required',
        'sort_order',
    ];

    protected $casts = [
        'required' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function visaType(): BelongsTo
    {
        return $this->belongsTo(VisaType::class);
    }

    public function professionType(): BelongsTo
    {
        return $this->belongsTo(ProfessionType::class);
    }
}
