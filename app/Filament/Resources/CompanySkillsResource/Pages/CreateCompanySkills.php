<?php

namespace App\Filament\Resources\CompanySkillsResource\Pages;

use App\Filament\Resources\CompanySkillsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanySkills extends CreateRecord
{
    protected static string $resource = CompanySkillsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array{
        $data["company_id"] = 1;
        return $data;
    }
}
