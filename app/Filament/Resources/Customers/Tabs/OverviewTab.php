<?php

namespace App\Filament\Resources\Customers\Tabs;

use App\Models\Customer;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs\Tab;

class OverviewTab extends Tab
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Overview')
            ->schema([
                TextEntry::make('name')
                    ->label('Name'),
                TextEntry::make('email')
                    ->label('Email Address'),
                TextEntry::make('phone')
                    ->label('Phone Number'),
                TextEntry::make('is_active')
                    ->label('Active Status')
                    ->formatStateUsing(fn (bool $state) => $state ? 'Active' : 'Inactive')
                    ->badge()
                    ->color(fn (Customer $record) => $record->is_active ? 'success' : 'danger'),
            ]);
    }
}
