<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkResource\Pages;
use App\Filament\Resources\WorkResource\RelationManagers;
use App\Models\Work;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorkResource extends Resource
{
    protected static ?string $model = Work::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Experiences';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Start Date')
                    ->schema([
                        TextInput::make('start_month')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(12)
                            ->step(1),

                        TextInput::make('start_year')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(2100)
                            ->step(1),
                    ])->columns(2),

                Fieldset::make('Stop Date')
                    ->schema([
                        TextInput::make('stop_month')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(12)
                            ->step(1),

                        TextInput::make('stop_year')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(2100)
                            ->step(1),
                    ])->columns(2),

                TextInput::make('title')->label('Company Name'),
                Select::make('experiences')
                    ->multiple()
                    ->searchable()
                    ->relationship('experiences', 'title'),
                RichEditor::make('description')->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('work_images')
                    ->label("Work Logo")
                    ->disk('local')
                    ->directory('form-attachments')
                    ->visibility('private')
                    ->image()
                    ->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Company Name'),
                TextColumn::make('start_month')
                    ->label('Start Period')
                    ->formatStateUsing(function ($state, Work $work) {
                        return $work->start_month . ' / ' . $work->start_year;
                    }),
                TextColumn::make('stop_month')
                    ->label('Stop Period')
                    ->formatStateUsing(function ($state, Work $work) {
                        return $work->stop_month . ' / ' . $work->stop_year;
                    }),
                TextColumn::make('description')->limit(50),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorks::route('/'),
            'create' => Pages\CreateWork::route('/create'),
            'edit' => Pages\EditWork::route('/{record}/edit'),
        ];
    }
}
