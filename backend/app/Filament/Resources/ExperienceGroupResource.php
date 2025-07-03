<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceGroupResource\Pages;
use App\Filament\Resources\ExperienceGroupResource\RelationManagers\ExperiencesRelationManager;
use App\Models\ExperienceGroup;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExperienceGroupResource extends Resource
{
    protected static ?string $model = ExperienceGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Experiences';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                RichEditor::make('description')->columnSpanFull(),
                ColorPicker::make('color')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Group Name'),
                ColorColumn::make('color')->copyable()
                    ->copyMessage('Copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('description')->limit(100),
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
            ExperiencesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperienceGroups::route('/'),
            'create' => Pages\CreateExperienceGroup::route('/create'),
            'edit' => Pages\EditExperienceGroup::route('/{record}/edit'),
        ];
    }
}
