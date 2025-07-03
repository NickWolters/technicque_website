<?php

namespace App\Filament\Resources\ExperienceGroupResource\RelationManagers;

use App\Models\Experience;
use App\Models\ExperienceLevel;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExperiencesRelationManager extends RelationManager
{
    protected static string $relationship = 'experiences';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title'),
                RichEditor::make('description')->columnSpanFull(),
                TextInput::make('start_year')->numeric()->minValue(1950)->maxValue(2100),
                Select::make('proficiency')
                    ->label('Proficiency')
                    ->options(ExperienceLevel::class)
                    ->searchable(),
                TextInput::make('icon_abbreviation')->maxLength(2)->label('Icon Abbreviation'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description')->limit(40),
                TextColumn::make('start_year')->label('Years Experience')
                    ->formatStateUsing(function ($state, Experience $experience) {
                        return (Carbon::now()->year - $experience->getAttribute('start_year')) . " years";
                    }),
                TextColumn::make('proficiency'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
