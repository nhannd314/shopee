<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class GeneralSettingsPage extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog;

    protected static string $settings = GeneralSettings::class;

    protected static ?int $navigationSort = 1;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('footer_text')
                    ->label('Footer Text')
                    ->rows(10)
                    ->columnSpanFull()
                    ->required(),

                Textarea::make('search_tags')
                    ->label('Search Tags')
                    ->rows(5)
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('facebook')
                    ->label('Facebook'),
                TextInput::make('tiktok')
                    ->label('Tiktok'),

                Section::make('Footer menu 1')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('footer_menu_1.menu_title')
                            ->label('Menu Title')
                            ->required(),
                        Repeater::make('footer_menu_1.items')
                            ->label('Menu Items')
                            ->columns(2)
                            ->schema([
                                TextInput::make('text')->label('Text'),
                                TextInput::make('link')->label('link'),
                            ])
                    ]),

                Section::make('Footer menu 2')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('footer_menu_2.menu_title')
                            ->label('Menu Title')
                            ->required(),
                        Repeater::make('footer_menu_2.items')
                            ->label('Menu Items')
                            ->columns(2)
                            ->schema([
                                TextInput::make('text')->label('Text'),
                                TextInput::make('link')->label('link'),
                            ])
                    ]),

                Section::make('Footer menu 3')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('footer_menu_3.menu_title')
                            ->label('Menu Title')
                            ->required(),
                        Repeater::make('footer_menu_3.items')
                            ->label('Menu Items')
                            ->columns(2)
                            ->schema([
                                TextInput::make('text')->label('Text'),
                                TextInput::make('link')->label('link'),
                            ])
                    ]),
            ]);
    }
}
