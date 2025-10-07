<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\UserRfqResource\Pages;
use App\Filament\User\Resources\UserRfqResource\RelationManagers;
use App\Models\Rfq;
use App\Models\RfqItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;

use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserRfqResource extends Resource
{
    protected static ?string $model = Rfq::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    protected static ?int $navigationSort = 99; 

    protected static ?string $navigationLabel = 'RFQs';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id())->latest();
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('S no.')->rowIndex(),
                TextColumn::make('rfq_user_company')
                    ->label('Company'),
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
                    ->html()
                    ->getStateUsing(function ($record) {
                        return $record->type === 'custom'
                            ? $record->custom_product_details
                            : $record->product_details;
                    }),

                TextColumn::make('product_count')
                    ->label('Total Products')
                    ->getStateUsing(function ($record) {
                        return $record->type === 'custom'
                            ? $record->custom_product_count
                            : $record->product_count;
                    }),
                TextColumn::make('created_at')->dateTime('d M Y'),
                
            ])
            ->actions([
                Action::make('chat_with_admin')
                    ->label('Chat with Admin')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn ($record) => "/user/thread?rfqId={$record->id}")
                    ->openUrlInNewTab(false)
                    ->visible(fn ($record) => $record->status === 'open')
                    ->tooltip('Start a conversation with admin about this RFQ'),
            ])
            ->searchable(false)
            ->filters([
                //
            ])
            ->paginated([5, 10, 20])
            ->emptyStateHeading('No records found')
            ->emptyStateDescription('You have to place a RFQ first.')
            ->emptyStateIcon('heroicon-o-document-text');
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
            // 'index' => Pages\ListUserRfqs::route('/'),
            // 'create' => Pages\CreateUserRfq::route('/create'),
            // 'edit' => Pages\EditUserRfq::route('/{record}/edit'),
            'index' => Pages\ListUserRfqs::route('/'),
        ];
    }
}
