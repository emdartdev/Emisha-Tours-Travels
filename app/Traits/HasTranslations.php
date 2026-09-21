<?php

namespace App\Traits;

trait HasTranslations
{
    /**
     * Get localized value for an attribute with fallback to English.
     */
    public function getTranslation(string $attribute, ?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        if ($locale === 'bn') {
            $bnAttribute = $attribute . '_bn';
            if (!empty($this->{$bnAttribute})) {
                return $this->{$bnAttribute};
            }
        }

        return $this->{$attribute} ?? null;
    }

    /**
     * Magic getter for localized attributes like $model->localized_title
     */
    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->getTranslation('title');
    }

    public function getLocalizedNameAttribute(): ?string
    {
        return $this->getTranslation('name');
    }

    public function getLocalizedCountryNameAttribute(): ?string
    {
        return $this->getTranslation('country_name');
    }

    public function getLocalizedShortDescriptionAttribute(): ?string
    {
        return $this->getTranslation('short_description');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->getTranslation('description');
    }

    public function getLocalizedContentAttribute(): ?string
    {
        return $this->getTranslation('content');
    }

    public function getLocalizedExcerptAttribute(): ?string
    {
        return $this->getTranslation('excerpt');
    }

    public function getLocalizedQuestionAttribute(): ?string
    {
        return $this->getTranslation('question');
    }

    public function getLocalizedAnswerAttribute(): ?string
    {
        return $this->getTranslation('answer');
    }

    public function getLocalizedValidityAttribute(): ?string
    {
        return $this->getTranslation('validity');
    }

    public function getLocalizedStayPeriodAttribute(): ?string
    {
        return $this->getTranslation('stay_period');
    }

    public function getLocalizedEntryTypeAttribute(): ?string
    {
        return $this->getTranslation('entry_type');
    }

    public function getLocalizedProcessingTimeAttribute(): ?string
    {
        return $this->getTranslation('processing_time');
    }

    public function getLocalizedProcessingTimeUnitAttribute(): ?string
    {
        return $this->getTranslation('processing_time_unit');
    }

    public function getLocalizedMealsAttribute(): ?string
    {
        return $this->getTranslation('meals');
    }

    public function getLocalizedStayAttribute(): ?string
    {
        return $this->getTranslation('stay');
    }

    /**
     * Check if Bangla translation exists for this model.
     */
    public function hasBanglaTranslation(string $attribute = 'title'): bool
    {
        $bnAttribute = $attribute . '_bn';
        return !empty($this->{$bnAttribute});
    }
}
