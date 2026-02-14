<?php

namespace App\Filament\Resources\Customers\Actions;

use App\Filament\Resources\Customers\Actions\UpdateCustomerEmailAction;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;

class ViewCustomerAction extends Action
{
    // setup from parent

    public function setup(): void
    {
        parent::setup();

        $this->label('View Customer');
        $this->icon('heroicon-o-eye')
            ->slideOver()
            ->modalSubmitAction(false)
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('email'),
                TextEntry::make('phone'),
                TextEntry::make('is_active')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                    ->color(fn($state) => $state ? 'success' : 'danger'),
            ])
            ->extraModalFooterActions([
                UpdateCustomerEmailAction::make(),
            ]);
    }

    public static function getDefaultName(): ?string
    {
        return 'view-customer';
    }
}
