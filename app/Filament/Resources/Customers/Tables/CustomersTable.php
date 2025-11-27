<?php

namespace App\Filament\Resources\Customers\Tables;

use App\Models\Customer;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Customers\Actions\ViewAction;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name'),
                TextColumn::make('email')
                    ->label('Email Address'),
                TextColumn::make('phone')
                    ->label('Phone Number'),
                TextColumn::make('is_active')
                    ->label('Active Status')
                    ->formatStateUsing(fn(bool $state) => $state ? 'Active' : 'Inactive')
                    ->badge()
                    ->color(fn(Customer $record) => $record->is_active ? 'success' : 'danger'),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->visible(fn(ListCustomers $livewire) => $livewire->activeTab === 'all'),
                ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                //
            ])
            ->toolbarActions([
                //
            ]);
    }
}
