<?php

namespace App\Filament\Resources\Customers\Actions;

use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;

class ViewRecordAction
{
    public static function make(): Action
    {
        return Action::make('view-record')
            ->label('View Record')
            ->modalSubmitAction(false)
            ->schema([
                TextEntry::make('name')
                    ->label('Name'),
                TextEntry::make('email')
                    ->label('Email'),
                TextEntry::make('phone')
                    ->label('Phone'),
                TextEntry::make('address')
                    ->label('Address'),
                TextEntry::make('is_active')
                    ->label('Active')
                    ->badge()
                    ->formatStateUsing(fn(bool $state) => $state ? 'Active' : 'Inactive'),
            ])
            ->slideOver()
            ->extraModalFooterActions([
                SetActive::make(),
                SetInactive::make(),
            ]);
    }
}
