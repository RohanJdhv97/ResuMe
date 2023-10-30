<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('role_id', '=', 3);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromForm()
                        ->withFilename('Candidate')
                        ->only([
                            'first_name', 'last_name', 'email','phone','role_id'
                        ])
                        ->withColumns([
                            Column::make('first_name')->heading('first_name'),
                            Column::make('last_name')->heading('last_name'),
                            Column::make('email')->heading('email'),
                            Column::make('phone')->heading('phone'),
                            Column::make('role_id')->heading('role_id'),
                        ])
                        ->askForFilename()
                        ->modifyQueryUsing(fn ($query) => $query->where('role_id', 3)),
                ]) 
        ];
    }
}
