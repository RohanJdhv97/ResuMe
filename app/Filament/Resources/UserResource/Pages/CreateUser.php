<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Summary of mutateFormDataBeforeCreate
     * @param array $data
     * @return array
     */
    protected function mutateFormDataBeforeCreate(array $data): array{
        // $actualPassword = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        // $data->password = Hash::make($actualPassword);
        $data["company_id"] = 1;
        // dd($data);
        return $data;

    }
}
