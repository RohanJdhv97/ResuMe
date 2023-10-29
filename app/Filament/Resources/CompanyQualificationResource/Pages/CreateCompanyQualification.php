<?php

namespace App\Filament\Resources\CompanyQualificationResource\Pages;

use App\Filament\Resources\CompanyQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanyQualification extends CreateRecord
{
    protected static string $resource = CompanyQualificationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array{
        $data["company_id"] = 1;
        return $data;
    }
}
