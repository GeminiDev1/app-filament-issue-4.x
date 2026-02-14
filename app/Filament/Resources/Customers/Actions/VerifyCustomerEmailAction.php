<?php

namespace App\Filament\Resources\Customers\Actions;

use Filament\Actions\Action;
use App\Models\Customer;
use Filament\Notifications\Notification;

class VerifyCustomerEmailAction extends Action
{
    public function setup(): void
    {
        parent::setup();

        $this->label('Verify Email');
        $this->icon('heroicon-o-check-circle')
            ->slideOver()
            ->requiresConfirmation()
            ->modalHeading('Verify Customer Email')
            ->modalDescription('Are you sure you want to verify the email of this customer?')
            ->modalSubmitActionLabel('Verify Email')
            ->modalCancelActionLabel('Cancel')
            ->mountUsing(function (Customer $customer, Action $action) {
                if (!$customer->is_active) {
                    Notification::make()
                        ->title('Customer is not active')
                        ->body('The customer is not active and cannot be verified.')
                        ->danger()
                        ->send();

                    $action->halt();
                }

                if ($customer->is_email_verified) {
                    Notification::make()
                        ->title('Email already verified')
                        ->body('The email of this customer is already verified.')
                        ->warning()
                        ->send();

                    $action->halt();
                }
            })
            ->action(function (Customer $customer) {
                $customer->update(['is_email_verified' => true]);
            });
    }

    public static function getDefaultName(): ?string
    {
        return 'verify-customer-email';
    }
}
