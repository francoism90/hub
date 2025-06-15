<?php

declare(strict_types=1);

namespace App\Api\Users\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'avatar' => $this->whenAppended('avatar'),
            $this->mergeWhen($request->user()->is($this) ?? $request->user()->hasRole('super-admin'), [
                'email' => $this->whenAppended('email'),
                'name' => $this->whenAppended('name'),
                'settings' => $this->whenAppended('settings'),
                'roles' => $this->whenLoaded('roles', $this->getRoleNames()),
                'permissions' => $this->whenLoaded('permissions', $this->getAllPermissions()),
                'created' => $this->whenAppended('created_at'),
                'updated' => $this->whenAppended('updated_at'),
            ]),
        ];
    }
}
