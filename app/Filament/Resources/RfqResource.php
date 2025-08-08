<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RfqResource\Pages;
use App\Filament\Resources\RfqResource\RelationManagers;
use App\Models\Rfq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;


class RfqResource extends Resource
{
    protected static ?string $model = Rfq::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationLabel = 'RFQs';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return Rfq::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Select::make('status')
                ->label('Status')
                ->options([
                    'open' => 'Open',
                    'closed' => 'Closed',
                ])
                ->required()
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('S no.')->rowIndex(),
                TextColumn::make('rfq_user_name')
                    ->label('Name'),
                TextColumn::make('rfq_user_email')
                    ->label('Email'),
                TextColumn::make('status')
                ->icon(fn (string $state): string => match ($state) {
                    'open' => 'heroicon-o-lock-open',
                    'closed' => 'heroicon-o-lock-closed',
                })
                ->color(fn (string $state): string => match ($state) {
                    'open' => 'success',
                    'closed' => 'danger',
                }),
                TextColumn::make('product_details')
                    ->label('Product Details')
                    ->wrap()
                    ->html(),
                TextColumn::make('product_count')
                    ->label('Total Products'),
                TextColumn::make('created_at')->label('RFQ Submission Date')->dateTime('d M Y'),
                
            ])
            ->paginated([5, 10, 20])
            ->emptyStateHeading('No records found')
            ->emptyStateDescription('No RFQ has been placed yet!')
            ->emptyStateIcon('heroicon-o-document-text')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('chat_with_user')
                    ->label('Chat with User')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn ($record) => "/admin/thread?rfqId={$record->id}")
                    ->openUrlInNewTab(false)
                    ->visible(fn ($record) => $record->status === 'open')
                    ->tooltip('Start a conversation with the customer about this RFQ'),
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
            'index' => Pages\ListRfqs::route('/'),
            'create' => Pages\CreateRfq::route('/create'),
            'edit' => Pages\EditRfq::route('/{record}/edit'),
        ];
    }
}
