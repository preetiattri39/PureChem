<?php

namespace App\Filament\Resources\UserResource\Pages;
use Filament\Notifications\Notification;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
