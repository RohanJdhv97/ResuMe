<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CandidateQualificationRelationManager extends RelationManager
{
    protected static string $relationship = 'candidateQualification';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('qualification')
                    ->required()
                    ->maxLength(255),
                TextInput::make('scored')
                    ->suffix('%')
                    ->maxLength(255)
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('qualification')
            ->columns([
                TextColumn::make('qualification')
                    ->placeholder('N/A')
                    ->label('Qualifications'),
                TextColumn::make('scored')
                    ->placeholder('N/A')
                    ->suffix('%'),
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
