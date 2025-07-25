<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {   
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'email' => $this->email,
            'estado' => $this->estado,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
        ];
    }
}
