<?php

namespace App\Filament\Resources\InterviewerResource\Pages;

use App\Filament\Resources\InterviewerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateInterviewer extends CreateRecord
{
    protected static string $resource = InterviewerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array{
        $actualPassword = Str::random(6);
        $data['password'] = Hash::make($actualPassword);
        $data["company_id"] = 1;
        $data['role_id'] = 4;
        return $data;
    }
}
