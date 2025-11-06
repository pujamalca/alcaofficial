<?php

namespace App\Filament\Admin\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(20),
                        TextInput::make('subject')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Message')
                    ->schema([
                        Textarea::make('message')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),

                Section::make('Status & Metadata')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'read' => 'Read',
                                'replied' => 'Replied',
                                'archived' => 'Archived',
                            ])
                            ->default('new')
                            ->required(),
                        DateTimePicker::make('read_at')
                            ->label('Read At'),
                        TextInput::make('ip_address')
                            ->disabled(),
                        Textarea::make('user_agent')
                            ->disabled()
                            ->rows(2),
                    ])->columns(2),
            ]);
    }
}
