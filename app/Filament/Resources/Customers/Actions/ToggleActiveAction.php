<?php

namespace App\Filament\Resources\Customers\Actions;

use App\Models\Customer;
use Filament\Actions\Action;

class ToggleActiveAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn (Customer $record) => $record->is_active ? 'Set as Inactive' : 'Set as Active')
            ->modalHeading(fn (Customer $record) => $record->is_active ? 'Set as Inactive?' : 'Set as Active?')
            ->modalSubmitActionLabel('Yes')
            ->modalWidth('sm')
            ->color(fn (Customer $record) => $record->is_active ? 'danger' : 'success')
            ->action(function (Customer $record) {
                $record->is_active = ! $record->is_active;
                $record->save();
            });
    }

    public static function getDefaultName(): ?string
    {
        return 'toggle-active-status';
    }
}
