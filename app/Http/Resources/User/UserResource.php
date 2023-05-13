<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $array = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($request->has('isContact')) {
            $array = array_merge($array,  [
                'isContact' => $this->contacts()->where('user_id', auth()->id())->exists()
            ]);
        }
        return $array;
    }
}
