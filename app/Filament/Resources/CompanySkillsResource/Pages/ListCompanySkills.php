<?php

namespace App\Filament\Resources\CompanySkillsResource\Pages;

use App\Filament\Resources\CompanySkillsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanySkills extends ListRecords
{
    protected static string $resource = CompanySkillsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
