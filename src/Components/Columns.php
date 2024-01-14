<?php

namespace Titantwentyone\FCCComponents\Components;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use RalphJSmit\Filament\MediaLibrary\Forms\Components\MediaPicker;
use Titantwentyone\FilamentContentComponents\Fields\ContentBuilder;

class Columns extends \Titantwentyone\FilamentContentComponents\Contracts\ContentComponent
{
    use \Titantwentyone\FilamentContentComponents\Contracts\CanRenderView;

    protected static $view = 'fccc::content.columns';

    public static function getLabel(): string
    {
        return "FCC Columns";
    }

    public static function getField(): array
    {
        return [
            TextInput::make('column_number')
                ->required()
                ->numeric()
                ->default(2)
                ->minValue(1)
                ->maxValue(4)
                ->reactive(),
            TextInput::make('virtual_column_number')
                ->required()
                ->numeric()
                ->default(2)
                ->minValue(fn($get) => $get('column_number'))
                ->maxValue(4)
                ->reactive(),
            Checkbox::make('contained')
                ->default(true)
                ->reactive(),
            Checkbox::make('gapped')
                ->label('Gapped?')
                ->hint('Provide spacing between columns')
                ->default(true),
            Checkbox::make('collapse_left_margin')
                ->default(false),
            Checkbox::make('collapse_right_margin')
                ->default(false),
            Checkbox::make('expand_left')
                ->label('Expand left column?')
                ->default(false)
                ->visible(fn($get) => $get('contained') == false),
            Checkbox::make('expand_right')
                ->label('Expand right column?')
                ->default(false)
                ->visible(fn($get) => $get('contained') == false),
            Section::make('column_properties')
                ->heading('Properties')
                ->schema([
                    Grid::make('background')
                        ->columns(12)
                        ->statePath('background')
                        ->schema(function($get) {
                            $columns = [];

                            foreach (range(1, $get('column_number')) as $column) {
                                $columns[] = MediaPicker::make('background_'.$column)
                                    ->columnSpan(fn($get) => static::getColumnSpan($get('../column_number')))
                                    ->reactive();
                            }
                            return $columns;
                        }),
                    Grid::make('collapsed')
                        ->columns(12)
                        ->statePath('collapsed')
                        ->schema(function($get) {
                            $columns = [];

                            $col_span = match($get('column_number')) {
                                '1' => 12,
                                '2' => 6,
                                '3' => 4,
                                default => 3
                            };

                            foreach (range(1, $get('column_number')) as $column) {
                                $columns[] = Checkbox::make('collapsed_'.$column)
                                    ->label('Collapse margins vertically?')
                                    ->columnSpan($col_span)
                                    ->reactive();
                            }
                            return $columns;
                        }),
                    Grid::make('classes')
                        ->columns(12)
                        ->statePath('classes')
                        ->schema(function($get) {
                            $columns = [];

                            foreach (range(1, $get('column_number')) as $column) {
                                $columns[] = TextInput::make('classes_'.$column)
                                    ->label('Column classes')
                                    ->columnSpan(fn($get) => static::getColumnSpan($get('../column_number')))
                                    ->reactive();
                            }
                            return $columns;
                        }),
                    Grid::make('span')
                        ->columns(12)
                        ->statePath('span')
                        ->schema(function($get) {

                            foreach (range(1, $get('column_number')) as $column) {
                                $columns[] = TextInput::make('span_'.$column)
                                    ->label('Column span')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(fn() => $get('../column_number'))
                                    ->maxValue(fn() => $get('../virtual_column_number'))
                                    ->columnSpan(fn($get) => static::getColumnSpan($get('../column_number')))
                                    ->reactive();
                            }
                            return $columns;
                        })
                ]),
            Grid::make('columns')
                ->columns(12)
                ->statePath('columns')
                ->reactive()
                ->schema(function($get) {

                    foreach (range(1, $get('column_number')) as $column) {
                        $columns[] = ContentBuilder::make('content_'.$column)
                            ->columnSpan(fn($get) => static::getColumnSpan($get('../column_number')))
                            ->reactive();
                    }
                    return $columns;
                })
        ];
    }

    private static function getColumnSpan(?int $column_number): int
    {
        return match($column_number) {
            1 => 12,
            2 => 6,
            3 => 4,
            default => 3
        };
    }
}