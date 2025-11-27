<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Customers'),
            'active' => Tab::make('Active Customers')
                ->modifyQueryUsing(fn($query) => $query->active()),
            'inactive' => Tab::make('Inactive Customers')
                ->modifyQueryUsing(fn($query) => $query->inactive()),
        ];
    }

    public function updatedActiveTab(): void
    {
        parent::updatedActiveTab();

        $this->resetTable();
    }
}
