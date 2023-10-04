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

    protected static $view = 'fcc::content.columns';

    public static function getField(): array
    {
        return [
            TextInput::make('column_number')
                ->required()
                ->numeric()
                ->minValue(2)
                ->maxValue(4)
                ->reactive(),
            Checkbox::make('contained')
                ->default(true)
                ->reactive(),
            Checkbox::make('gapped?')
                ->default(true),
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

                            $col_span = match($get('column_number')) {
                                '2' => 6,
                                '3' => 4,
                                default => 3
                            };

                            foreach (range(1, $get('column_number')) as $column) {
                                $columns[] = MediaPicker::make('background_'.$column)
                                    ->columnSpan($col_span)
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
                        })
                ]),
            Grid::make('columns')
                ->columns(12)
                ->statePath('columns')
                ->reactive()
                ->schema(function($get) {
                    $columns = [];

                    $col_span = match($get('column_number')) {
                        '2' => 6,
                        '3' => 4,
                        default => 3
                    };

                    foreach (range(1, $get('column_number')) as $column) {
                        $columns[] = ContentBuilder::make('content_'.$column)
                            ->columnSpan($col_span)
                            ->reactive();
                    }
                    return $columns;
                })
        ];
    }
}