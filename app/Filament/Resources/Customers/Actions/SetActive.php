<?php

namespace App\Filament\Resources\Customers\Actions;

use Filament\Actions\Action;
use App\Models\Customer;

class SetActive
{
    public static function make(): Action
    {
        return Action::make('set-active')
            ->label('Set Active')
            ->action(function (Customer $record) {
                $record->update(['is_active' => true]);
            })
            ->visible(fn(Customer $record) => $record->is_active === false)
            ->color('success');
    }
}