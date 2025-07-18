<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_code')->label('Product Code')->maxLength(255),
                TextInput::make('compound_family')->label('Compound Family')->maxLength(255),
                TextInput::make('name')->required()->maxLength(255),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),
                Textarea::make('synonym')->maxLength(65535),
                TextInput::make('molecular_formula')->maxLength(255),
                TextInput::make('molecular_weight')->numeric()->step(0.001),
                TextInput::make('cas_number')->maxLength(255),
                TextInput::make('purity')->maxLength(255),
                Textarea::make('storage'),
                TextInput::make('aspect')->maxLength(255),
                Textarea::make('patents'),
                Textarea::make('uses'),
                Toggle::make('out_of_stock')->label('Out of Stock'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_code')->label('Code')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('compound_family')->label('Family')->limit(20),
                TextColumn::make('category.name')->label('Category')->sortable()->searchable(),
                IconColumn::make('out_of_stock')->boolean()->label('Out of Stock'),
                TextColumn::make('cas_number')->label('CAS #'),
                TextColumn::make('molecular_formula')->label('Formula'),
                TextColumn::make('molecular_weight')->label('Weight'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
