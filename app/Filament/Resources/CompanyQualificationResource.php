<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyQualificationResource\Pages;
use App\Filament\Resources\CompanyQualificationResource\RelationManagers;
use App\Models\CompanyQualification;
use App\Models\CompanyQualificationMaster;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyQualificationResource extends Resource
{
    protected static ?string $model = CompanyQualificationMaster::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Company Qualifications';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('qualification')
                    ->label('Qualification')
                    ->required()
                    ->columnSpan([
                        'sm' => 2,
                        'md' => 1,
                        'lg' => 1
                    ]),
                TextInput::make('threshold')
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
                TextColumn::make('qualification')
                    ->label('Qualification')
                    ->searchable()
                    ->placeholder('No description.')
                    ->sortable(),
                TextColumn::make('threshold')
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
            'index' => Pages\ListCompanyQualifications::route('/'),
            'create' => Pages\CreateCompanyQualification::route('/create'),
            'edit' => Pages\EditCompanyQualification::route('/{record}/edit'),
        ];
    }    
}
