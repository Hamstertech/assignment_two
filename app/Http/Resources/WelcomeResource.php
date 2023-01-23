<?php

namespace App\Http\Resources;

use App\Models\Song;
use Illuminate\Http\Resources\Json\JsonResource;

class WelcomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fname' => $this->first_name,
            'lname' => $this->last_name,
            'dob' => $this->date_of_birth,
            'nationality' => $this->nationality,
            'books' => $this->books->count() ?? 0,
            'songs' => $this->songs->count() ?? 0,
            'films' => $this->films->count() ?? 0,
            // 'media' => $names,
        ];
    }
}
