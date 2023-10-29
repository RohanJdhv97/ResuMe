<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanySkillsResource\Pages;
use App\Filament\Resources\CompanySkillsResource\RelationManagers;
use App\Models\CompanySkillMaster;
use App\Models\CompanySkills;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanySkillsResource extends Resource
{
    protected static ?string $model = CompanySkillMaster::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Skill')
                    ->required()
                    ->columnSpan([
                        'sm' => 2,
                        'md' => 1,
                        'lg' => 1
                    ]),
                TextInput::make('cutoff')
                    ->label('Cutoff')
                    ->numeric()
                    ->maxValue(100)
                    ->suffix('%')
                    ->columnSpan([
                        'sm' => 2,
                        'md' => 1,
                        'lg' => 1
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Skills')
                    ->searchable()
                    ->placeholder('No description.')
                    ->sortable(),
                TextColumn::make('cutoff')
                    ->label('Cutoff')
                    ->searchable()
                    ->placeholder('No description.')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanySkills::route('/'),
            'create' => Pages\CreateCompanySkills::route('/create'),
            'edit' => Pages\EditCompanySkills::route('/{record}/edit'),
        ];
    }
}
