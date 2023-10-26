<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Select::make('role_id')
                    ->required()
                    ->relationship('name','id')
                    ->label('Role')
                    ->options(fn () => Role::whereNot([
                        ['name','=','Super Admin'],
                    ])->pluck('name','id'))
                    ->searchable()
                    ->reactive()
                    ->columnSpan([
                        'sm' => 2,
                        'md' => 1,
                        'lg' => 1
                    ]),
                FileUpload::make('url')
                    ->required()
                    ->reactive()
                    ->label('Resume')
                    ->hidden(fn (callable $get) => $get('role_id') != 3)
                    ->columnSpan([
                        'sm' => 2,
                        'md' => 2,
                        'lg' => 2
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
