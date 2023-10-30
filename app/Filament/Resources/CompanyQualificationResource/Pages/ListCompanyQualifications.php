<?php

namespace App\Filament\Resources\CompanyQualificationResource\Pages;

use App\Filament\Resources\CompanyQualificationResource;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListCompanyQualifications extends ListRecords
{
    protected static string $resource = CompanyQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExcelImportAction::make()
                ->color('primary'),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromForm()
                        ->withFilename('Company Skills')
                        ->only([
                            'qualification',
                            'threshold',
                            'company_id'
                        ])
                        ->withColumns([
                            Column::make('qualification')->heading('qualification'),
                            Column::make('threshold')->heading('threshold'),
                            Column::make('company_id')->heading('company_id'),
                        ])
                        ->askForFilename(),
                ])
        ];
    }
}
