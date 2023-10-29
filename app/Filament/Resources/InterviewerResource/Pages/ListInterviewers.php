<?php

namespace App\Filament\Resources\InterviewerResource\Pages;

use App\Filament\Resources\InterviewerResource;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListInterviewers extends ListRecords
{
    protected static string $resource = InterviewerResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('role_id', '=', 4);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExcelImportAction::make()
            ->color('primary')
        ];
    }
}
