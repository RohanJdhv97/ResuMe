<?php

namespace App\Filament\Resources\CompanySkillsResource\Pages;

use App\Filament\Resources\CompanySkillsResource;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListCompanySkills extends ListRecords
{
    protected static string $resource = CompanySkillsResource::class;

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
                            'name','cutoff','company_id'
                        ])
                        ->withColumns([
                            Column::make('name')->heading('name'),
                            Column::make('cutoff')->heading('cutoff'),
                            Column::make('company_id')->heading('company_id'),
                        ])
                        ->askForFilename(),
                ]) 
        ];
    }
}
