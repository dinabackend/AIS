<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $slug = 'abouts';

    protected static ?string $navigationIcon = 'heroicon-s-flag';

    public static function getNavigationBadge(): ?string
    {
        return About::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        TextInput::make($tab->makeName('title'))
                            ->required($tab->makeName('title') === 'uz.title')
                            ->maxLength(255)
                            ->label(__('form.title')),
                        TextInput::make($tab->makeName('subtitle'))
                            ->required($tab->makeName('subtitle') === 'uz.subtitle')
                            ->maxLength(255)
                            ->label(__('form.subtitle')),
                        RichEditor::make($tab->makeName('description'))
                            ->required($tab->makeName('description') === 'uz.description')
                            ->label(__('form.description')),
                    ])->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->visibility(true)
                    ->collection('about_image')
                    ->label(__('form.image'))
                    ->columnSpanFull()
                    ->image(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                SpatieMediaLibraryImageColumn::make('image')->collection('about_image')
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
