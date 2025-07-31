<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;
use App\Models\Rfq;

class ChatPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static string $view = 'filament.user.pages.chat-page';

    protected static ?int $navigationSort = 99; 

    protected static ?string $navigationLabel = 'Threads';

    protected static ?string $title = 'Threads';

    // public function getRfqRecordsProperty()
    // {
    //     return Rfq::with('user')
    //               ->latest()
    //               ->paginate(10);
    // }

}
