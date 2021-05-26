<?php

namespace App\Traits;

trait HasTranslations{
    public function getTranslation($field, string $locale = 'it'){
        return $this->translations()->where(['field' => $field, 'locale' => $locale])->pluck('text')->first();
    }

    public function setTranslation($text, $field, string $locale = 'it'){
        if($translation = $this->translations()->where(['field' => $field, 'locale' => $locale])->first()){
            $translation->update(['text' => $text]);
        } else {
            $this->translations()->create([
                'field' => $field,
                'text' => $text,
                'locale' => $locale
            ]);
        }
    }
}
