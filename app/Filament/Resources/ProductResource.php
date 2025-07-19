<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_code')
                    ->label('Product Code')
                    ->maxLength(255)
                    ->live(onBlur: true),

                TextInput::make('compound_family')
                    ->label('Compound Family')
                    ->maxLength(255)
                    ->live(onBlur: true),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),

                Textarea::make('synonym')
                    ->maxLength(65535)
                    ->live(onBlur: true),

                TextInput::make('molecular_formula')
                    ->maxLength(255)
                    ->live(onBlur: true),

                TextInput::make('molecular_weight')
                    ->numeric()
                    ->step(0.001)
                    ->live(onBlur: true),

                TextInput::make('cas_number')
                    ->maxLength(255)
                    ->live(onBlur: true),

                TextInput::make('purity')
                    ->maxLength(255)
                    ->live(onBlur: true),

                Textarea::make('storage')
                    ->live(onBlur: true),

                TextInput::make('aspect')
                    ->maxLength(255)
                    ->live(onBlur: true),

                Textarea::make('patents')
                    ->live(onBlur: true),

                Textarea::make('uses')
                    ->live(onBlur: true),

                Toggle::make('out_of_stock')
                    ->label('Out of Stock'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_code')
                    ->label('Code')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Category'),

                IconColumn::make('out_of_stock')
                    ->label('Out of Stock')
                    ->boolean(fn ($state) => $state == 0)
                    ->trueColor('success')
                    ->falseColor('danger'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
