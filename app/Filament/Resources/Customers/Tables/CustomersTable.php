<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('delete')
                    ->label('Delete')
                    ->schema([
                        Wizard::make([
                            Step::make('reason')
                                ->schema([
                                    TextInput::make('reason')
                                        ->label('Reason for Deletion')
                                        ->required()
                                ])
                                ->skippable(), // <-------- Errors
                            Step::make('confirm')
                                ->schema([
                                    TextInput::make('confirm')
                                        ->label('Type "DELETE" to confirm')
                                        ->required()
                                ])
                        ])
                        ->skippable() // <-------- This is ok
                    ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
