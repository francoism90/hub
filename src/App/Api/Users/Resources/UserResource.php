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
            $this->mergeWhen($this->whenAppended('settings') && ($request->user()->is($this) ?? $request->user()->hasRole('super-admin')), [
                'email' => $this->whenAppended('email'),
                'permissions' => $this->whenAppended('permissions', $this->getAllPermissions()->pluck('name')),
                'roles' => $this->whenAppended('roles', $this->getRoleNames()),
                'settings' => $this->whenAppended('settings'),
                'created_at' => $this->whenAppended('created_at'),
                'updated_at' => $this->whenAppended('updated_at'),
            ]),
        ];
    }
}
