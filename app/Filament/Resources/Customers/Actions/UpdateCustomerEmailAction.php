<?php

namespace App\Filament\Resources\Customers\Actions;

use Filament\Actions\Action;
use App\Models\Customer;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class UpdateCustomerEmailAction extends Action
{
    public function setup(): void
    {
        parent::setup();

        $this->label('Update Email');
        $this->icon('heroicon-o-check-circle')
            ->slideOver()
            ->requiresConfirmation()
            ->modalHeading('Update Customer Email')
            ->modalDescription('Are you sure you want to update the email of this customer?')
            ->modalSubmitActionLabel('Update Email')
            ->modalCancelActionLabel('Cancel')
            ->mountUsing(function (Customer $customer, Action $action) {
                if (!$customer->is_active) {
                    Notification::make()
                        ->title('Customer is not active')
                        ->body('The customer is not active and cannot be updated.')
                        ->danger()
                        ->send();

                    $action->halt();
                }
            })
            ->schema([
                TextInput::make('email')
                    ->email()
                    ->required(),
            ])
            ->action(function (Customer $customer, array $data) {
                $customer->email = $data['email'];
                $customer->save();

                Notification::make()
                    ->title('Email updated')
                    ->body('The email of this customer has been updated.')
                    ->success()
                    ->send();
            });
    }

    public static function getDefaultName(): ?string
    {
        return 'update-customer-email';
    }
}
