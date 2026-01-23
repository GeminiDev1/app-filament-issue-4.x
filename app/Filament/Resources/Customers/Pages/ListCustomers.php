<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    // Tab active or inactive
    public function getTabs(): array
    {
        return [
            'active' => Tab::make('Active')
                ->query(fn(Builder $query) => $query->where('is_active', true)),
            'inactive' => Tab::make('Inactive')
                ->query(fn(Builder $query) => $query->where('is_active', false)),
        ];
    }
}
