<?php

namespace App\Filament\Resources\CompanyQualificationResource\Pages;

use App\Filament\Resources\CompanyQualificationResource;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyQualifications extends ListRecords
{
    protected static string $resource = CompanyQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExcelImportAction::make()
                ->color('primary')
        ];
    }
}
