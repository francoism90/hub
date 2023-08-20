<?php

namespace App\Admin\Resources\ProfileResource\Pages;

use App\Admin\Concerns\InteractsWithFormData;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class EditProfile extends BaseEditProfile
{
    use InteractsWithFormData;

    public function getRecord(): Authenticatable&Model
    {
        return $this->getUser();
    }
}
