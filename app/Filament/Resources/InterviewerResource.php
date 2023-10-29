<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InterviewerResource\Pages;
use App\Filament\Resources\InterviewerResource\RelationManagers;
use App\Models\Interviewer;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InterviewerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Interviewer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->columnSpan([
                        'sm' => 2,
                        'md' => 1,
                        'lg' => 1
                    ]),
                TextInput::make('last_name')
                    ->columnSpan([
                        'sm' => 2,
                        'md' => 1,
                        'lg' => 1
                    ]),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->columnSpan([
                        'sm' => 2,
                        'md' => 1,
                        'lg' => 1
                    ]),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->minLength(10)
                    ->maxLength(10)
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
                TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable()
                    ->placeholder('No description.')
                    ->sortable(),
                TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable()
                    ->placeholder('No description.')
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->copyMessage('Email Id copied')
                    ->copyMessageDuration(1500)
                    ->placeholder('N/A')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Phone Number')
                    ->icon('heroicon-m-phone')
                    ->copyable()
                    ->copyMessage('Phone number copied')
                    ->copyMessageDuration(1500)
                    ->placeholder('N/A')
                    ->searchable()
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
            'index' => Pages\ListInterviewers::route('/'),
            'create' => Pages\CreateInterviewer::route('/create'),
            'edit' => Pages\EditInterviewer::route('/{record}/edit'),
        ];
    }    
}
