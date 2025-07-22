<?php

namespace App\Http\Services;

use App\Models\Language;
use Illuminate\Support\Facades\Schema;

class TranslateService
{
    /**
     * Set translations for a given model instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $model            Fully qualified model name (e.g. App\Models\Product)
     * @param  int     $model_id         ID of the model instance
     * @return void
     */
    public static function set_translate($request, $model, $model_id)
    {
        // Extract model class name (e.g. Product from App\Models\Product)
        $model_name_parts = explode("\\", $model);
        $model_name = end($model_name_parts);

        // Get related translate model (e.g. App\Models\ProductTranslate)
        $model_translate_name = $model . "Translate";

        // Convert model name from camelCase to snake_case (e.g. product)
        $model_snake = self::from_camel_case($model_name);

        // Delete old translations for the given model instance
        $model_translate_name::where($model_snake . "_id", $model_id)->delete();

        // Get all columns from the corresponding translation table
        $columns = Schema::getColumnListing($model_snake . "_translates");

        // Fetch all active languages
        $languages = Language::active()->get();

        // Get the default language
        $default_lang = Language::where("is_default", true)->first();

        $all_translations = [];

        // Loop through each language to prepare translation data
        foreach ($languages as $lang) {
            $translation_data = [];

            foreach ($columns as $col) {
                // Skip timestamps and ID column
                if (in_array($col, ["id", "created_at", "updated_at"])) {
                    continue;
                }

                // Set lang and foreign key fields
                if ($col == "lang") {
                    $translation_data["lang"] = $lang->code;
                } elseif ($col == $model_snake . "_id") {
                    $translation_data[$col] = $model_id;
                } else {
                    // If default language, use required value
                    if ($lang->is_default) {
                        $translation_data[$col] = $request[$col . "_" . $lang->code] ?? null;
                    } else {
                        // If non-default language, fallback to default language if empty
                        $translation_data[$col] = $request[$col . "_" . $lang->code]
                            ?? $request[$col . "_" . $default_lang->code]
                            ?? null;
                    }
                }
            }

            // Add prepared translation if not empty
            if (!empty($translation_data)) {
                $all_translations[] = $translation_data;
            }
        }

        // Bulk insert all translations
        $model_translate_name::insert($all_translations);
    }

    /**
     * Get translated value for specific language and column.
     *
     * @param  object  $item   Model instance with relation `all_translate`
     * @param  string  $lang   Language code (e.g. 'en', 'ar')
     * @param  string  $col    Column name to fetch (e.g. 'title')
     * @return string|null
     */
    public static function get_value($item, $lang, $col)
    {
        if (isset($item->all_translate->groupBy('lang')[$lang])) {
            return $item->all_translate->groupBy('lang')[$lang][0][$col] ?? null;
        }

        return null;
    }

    /**
     * Convert camelCase or PascalCase string to snake_case.
     *
     * @param  string  $input
     * @return string
     */
    public static function from_camel_case($input)
    {
        preg_match_all(
            '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!',
            $input,
            $matches
        );

        $segments = $matches[0];

        foreach ($segments as &$segment) {
            $segment = ($segment === strtoupper($segment))
                ? strtolower($segment)
                : lcfirst($segment);
        }

        return implode('_', $segments);
    }
}
