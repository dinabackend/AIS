<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers\ChildrenRelationManager;
use App\Models\Category;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;

class CategoryResource extends Resource
{

    public static function getLabel(): ?string
    {
        return __('panel.categories');
    }

    public static function getPluralLabel(): ?string
    {
        return __('panel.categories');
    }

    public static function getNavigationBadge(): ?string
    {
        return Category::count();
    }

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';

    protected static ?string $navigationGroup = 'Catalog Management';

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('panel.catalog_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        Forms\Components\TextInput::make($tab->makeName('name'))
                            ->required()
                            ->maxLength(255)
                            ->label(__('form.name')),
                        Forms\Components\Textarea::make($tab->makeName('description'))
                    ])->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('category_img')
                    ->image()
                    ->imageEditor()
                    ->multiple()
                    ->collection('category_img')
                    ->label(__('form.image')),

                Select::make('parent_id')
                    ->label('Parent Category')
                    ->options(fn ($get) => Category::query()->whereNull('parent_id')
                        ->where('id', '!=', $get('id'))
                        ->with('translations')
                        ->get()
                        ->mapWithKeys(function ($category) {
                            $name = $category->getTranslation(app()->getLocale())->name ??
                                   $category->getTranslation('uz')->name ??
                                   'No Name';
                            return [$category->id => $name];
                        })
                    )
                    ->preload()
                    ->nullable(),

                Forms\Components\Toggle::make('home_visibility')->label(__('form.home_visibility'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('parent.name')->label('Parent Category'),
            ])
            ->reorderable('order')
            ->defaultSort('order')
            ->filters([
                //
            ])
            ->actions([
                RelationManagerAction::make('category-relation-manager')->label('')->icon('heroicon-s-rectangle-stack')->relationManager(ChildrenRelationManager::make()),
                Tables\Actions\EditAction::make()->label(''),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
