<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontGenreRequest extends FormRequest {

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /* TODO: Change max and min genre count from config or setting */
        $maxGenreCount = config('app.settings.app_max_genre_count');
        $minGenreCount = config('app.settings.app_min_genre_count');

        return [
            'genres'   => ['required', 'array', "min:$minGenreCount", "max:$maxGenreCount"],
            'genres.*' => ['string', 'exists:genres,name'],
        ];
    }
}
