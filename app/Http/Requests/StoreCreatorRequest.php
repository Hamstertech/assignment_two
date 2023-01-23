<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data.first_name' => 'required|string',
            'data.last_name' => 'required|string',
            'data.nationality' => 'required|string',
            'data.date_of_birth' => 'required|date',
            'data.songs' => 'array',
            'data.songs.*.name' => 'string',
            'data.songs.*.genre' => 'string',
            'data.songs.*.duration' => 'integer',
            'data.songs.*.record_label' => 'string',
            'data.songs.*.tempo' => 'string',
            'data.films' => 'array',
            'data.films.*.title' => 'string',
            'data.films.*.production_studio' => 'string',
            'data.films.*.cost_to_produce' => 'integer',
            'data.films.*.language' => 'string',
            'data.films.*.genre' => 'string',
            'data.books' => 'array',
            'data.books.*.title' => 'string',
            'data.books.*.isbn' => 'integer',
            'data.books.*.publishing_house' => 'string',
            'data.books.*.language' => 'string',
            'data.books.*.genre' => 'string',
        ];
    }
}
