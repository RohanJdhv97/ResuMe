<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CandidateExperienceRelationManager extends RelationManager
{
    protected static string $relationship = 'candidateExperience';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('details')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'underline',
                        'bulletList',
                        'h1',
                        'h2',
                        'undo',
                        'redo'
                    ])
                    ->columnSpan([
                        'lg' => 2,
                        'md' => 2,
                        'sm' => 2
                    ]),
                TextInput::make('experience_in_months')
                    ->required(),

                Repeater::make('technologies')
                    ->schema([
                        TextInput::make('skill')
                            ->required()
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('details')
            ->columns([
                TextColumn::make('details')
                    ->html(),
                TextColumn::make('experience_in_months')
                    ->suffix(' month(s)')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
