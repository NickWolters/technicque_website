<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudyResource\Pages;
use App\Filament\Resources\StudyResource\RelationManagers;
use App\Models\Study;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudyResource extends Resource
{
    protected static ?string $model = Study::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

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

                TextInput::make('title'),
                TextInput::make('degree_type')->name('degree'),
                RichEditor::make('description')->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('study_institute')
                    ->label("Icon Institution")
                    ->disk('local')
                    ->directory('form-attachments')
                    ->visibility('private')
                    ->image()
                    ->imageEditor()
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('degree_type'),
                TextColumn::make('start_month')
                    ->label('Start Period')
                    ->formatStateUsing(function ($state, Study $study) {
                        return $study->start_month . ' / ' . $study->start_year;
                    }),
                TextColumn::make('stop_month')
                    ->label('Stop Period')
                    ->formatStateUsing(function ($state, Study $study) {
                        return $study->stop_month . ' / ' . $study->stop_year;
                    }),
                TextColumn::make('description')->limit(50),
                ImageColumn::make('image')
                    ->disk('local')
                    ->circular()
                    ->visibility('private'),
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListStudies::route('/'),
            'create' => Pages\CreateStudy::route('/create'),
            'edit' => Pages\EditStudy::route('/{record}/edit'),
        ];
    }
}
