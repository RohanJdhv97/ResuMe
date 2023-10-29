<?php

namespace App\Filament\Resources\CompanySkillsResource\Pages;

use App\Filament\Resources\CompanySkillsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanySkills extends EditRecord
{
    protected static string $resource = CompanySkillsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
