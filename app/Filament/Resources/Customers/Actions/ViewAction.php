<?php

namespace App\Filament\Resources\Customers\Actions;

use App\Filament\Resources\Customers\Actions\ToggleActiveAction;
use App\Filament\Resources\Customers\Tabs\OverviewTab;
use Filament\Actions\Action;
use Filament\Schemas\Components\Tabs;

class ViewAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('View')
            ->modalHeading('View Customer Details')
            ->slideOver()
            ->modalSubmitAction(false)
            ->schema([
                Tabs::make('tabs')
                    ->tabs([
                        OverviewTab::make()
                    ]),
            ])
            ->modalFooterActions([
                ToggleActiveAction::make(),
            ]);
    }

    public static function getDefaultName(): ?string
    {
        return 'view';
    }
}
