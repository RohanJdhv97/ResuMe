<?php

namespace App\Filament\Resources\CompanyQualificationResource\Pages;

use App\Filament\Resources\CompanyQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyQualification extends EditRecord
{
    protected static string $resource = CompanyQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
