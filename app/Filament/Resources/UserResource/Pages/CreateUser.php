<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Jobs\ResumeProcessingJob;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Summary of mutateFormDataBeforeCreate
     * @param array $data
     * @return array
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $actualPassword = Str::random(6);
        $data['password'] = Hash::make($actualPassword);
        $data["company_id"] = 1;
        $data['role_id'] = 3;
        return $data;
    }

    protected function afterCreate(): void
    {
       ResumeProcessingJob::dispatch($this->record);
    }
}
