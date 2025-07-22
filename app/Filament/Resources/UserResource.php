<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('password')
                    ->password()
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->dehydrated(fn(?string $state): bool => filled($state))
                    ->label('Password'),

                TextInput::make('phone')
                    ->label('Phone')
                    ->maxLength(20),

                TextInput::make('city')
                    ->label('City')
                    ->maxLength(255),

                TextInput::make('country')
                    ->label('Country')
                    ->maxLength(255),

                TextInput::make('company')
                    ->label('Company')
                    ->maxLength(255),

                TextInput::make('purpose')
                    ->label('Purpose')
                    ->maxLength(255),

                TextInput::make('province')
                    ->label('Province')
                    ->maxLength(255),

                TextInput::make('postal_code')
                    ->label('Postal Code')
                    ->maxLength(20),

                Select::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone')->label('Phone')->searchable(),
                BadgeColumn::make('role')
                    ->label('Role')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'admin' => 'Admin',
                        'user' => 'User',
                        default => ucfirst($state),
                    })
                    ->colors([
                        'success' => fn(string $state): bool => $state === 'admin',
                        'secondary' => fn(string $state): bool => $state === 'user',
                    ]),
            ])
            ->paginated([5, 10, 20])
            ->defaultPaginationPageOption(5)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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

    public static function canEdit(Model $record): bool
    {
        return true;
    }

    public static function canDelete(Model $record): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return true;
    }
}
