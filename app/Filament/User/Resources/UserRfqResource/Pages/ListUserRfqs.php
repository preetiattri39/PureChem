<?php

namespace App\Filament\User\Resources\UserRfqResource\Pages;

use App\Filament\User\Resources\UserRfqResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserRfqs extends ListRecords
{
    protected static string $resource = UserRfqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
