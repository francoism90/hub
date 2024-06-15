<?php

namespace App\Api\Authentication\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class UserResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'name' => $this->whenAppended('name'),
            'email' => $this->whenAppended('email'),
            'roles' => $this->whenAppended('roles', $this->roles()),
            'permissions' => $this->whenAppended('permissions', $this->permissions()),
            'state' => $this->whenAppended('state'),
            'created_at' => $this->whenAppended('created_at'),
            'updated_at' => $this->whenAppended('updated_at'),
        ];
    }

    protected function roles(): Collection
    {
        return $this->getRoleNames();
    }

    protected function permissions(): Collection
    {
        return $this->getAllPermissions()->pluck('name');
    }
}
