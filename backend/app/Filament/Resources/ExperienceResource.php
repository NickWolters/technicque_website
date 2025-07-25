<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;use App\Filament\Resources\ExperienceResource\Pages\RelationsManagers\ExperienceGroupsRelationManager;use App\Filament\Resources\ExperienceResource\RelationManagers;use App\Models\Experience;use App\Models\ExperienceGroup;use App\Models\ExperienceLevel;use Carbon\Carbon;use Filament\Forms\Components\RichEditor;use Filament\Forms\Components\Select;use Filament\Forms\Components\SpatieMediaLibraryFileUpload;use Filament\Forms\Components\TextInput;use Filament\Forms\Form;use Filament\Resources\Resource;use Filament\Tables;use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Experiences';

    public static function form(Form $form): Form
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
                Select::make('experience_group_id')
                    ->label('Group')
                    ->options(ExperienceGroup::all()->pluck('name', 'id'))
                    ->searchable(),
                TextInput::make('icon_abbreviation')->maxLength(2)->label('Icon Abbreviation'),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('experiences')
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
                TextColumn::make('description'),
                TextColumn::make('start_year')->label('Years Experience')
                    ->formatStateUsing(function ($state, Experience $experience) {
                        return (Carbon::now()->year - $experience->getAttribute('start_year')) . " years";
                    }),
                TextColumn::make('proficiency'),
            ])
            ->filters([
                SelectFilter::make('ExperienceGroup')->relationship('experience_group', 'name')
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
