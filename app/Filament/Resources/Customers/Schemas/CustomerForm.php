<?php

namespace App\Filament\Resources\Customers\Schemas;

use Dom\Text;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('First Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone Number'),
                TextInput::make('address')
                    ->label('Mailing Address'),
                RichEditor::make('notes')
                    ->label('Additional Notes')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                        'blockquote',
                    ]),
            ]);
    }
}
