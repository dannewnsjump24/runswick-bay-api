<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Domain\Trips\Models\Trip;
use App\Filament\Resources\TripResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->maxDate(now()->addYear()),
                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->maxDate(now()->addYear()),
                Forms\Components\FileUpload::make('cover_photo')
                    ->directory('trip-cover-images')
                    ->visibility('private')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->weight(FontWeight::Bold),
                Tables\Columns\TextColumn::make('start_date')->date('Y-m-d'),
                Tables\Columns\TextColumn::make('end_date')->date('Y-m-d'),
                Tables\Columns\TextColumn::make('owner.name'),
                Tables\Columns\TextColumn::make('locations_count')
                    ->counts('locations')
                    ->label('Locations')
                    ->url(fn (Trip $record): string => route('filament.admin.resources.locations.index', [
                        'tableFilters[trip][values][0]' => $record->id,
                    ])),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('owner')
                    ->multiple()
                    ->relationship('owner', 'name')
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}
