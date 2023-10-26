<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate($data){
        // $actualPassword = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        // $data->password = Hash::make($actualPassword);
        $data->company_id = 1;
        return $data;

    }
}
