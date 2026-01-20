<?php

namespace App\Filament\Resources\Customers\Actions;

use Filament\Actions\Action;
use App\Models\Customer;

class SetInactive
{
    public static function make(): Action
    {
        return Action::make('set-inactive')
            ->label('Set Inactive')
            ->action(function (Customer $record) {
                $record->update(['is_active' => false]);
            })
            ->visible(fn(Customer $record) => $record->is_active === true);
    }
}