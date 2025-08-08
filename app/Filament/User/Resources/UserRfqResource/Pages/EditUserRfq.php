<?php

namespace App\Filament\User\Resources\UserRfqResource\Pages;

use App\Filament\User\Resources\UserRfqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserRfq extends EditRecord
{
    protected static string $resource = UserRfqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
