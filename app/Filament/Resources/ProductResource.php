<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\CharacteristicsRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\TypesRelationManager;
use App\Models\GroupTranslation;
use App\Models\Product;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;


class ProductResource extends Resource
{
    use ResourceTranslatable;

    public static function getLabel(): ?string
    {
        return __('panel.products');
    }

    public static function getPluralLabel(): ?string
    {
        return __('panel.products');
    }

    public static function getNavigationBadge(): ?string
    {
        return Product::count();
    }

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-lifebuoy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('form.content'))->schema([
                    TranslatableTabs::make()
                        ->localeTabSchema(fn(TranslatableTab $tab) => [
                            TextInput::make($tab->makeName('name'))
                                ->required($tab->makeName('name') === 'uz.name')
                                ->label(__('form.name')),
                            Textarea::make($tab->makeName('ingredients'))
                                ->label(__('form.ingredients')),
                            Textarea::make($tab->makeName('description'))
                                ->rows(10)
                                ->required($tab->makeName('description') === 'uz.description')
                                ->label(__('form.description')),
                        ])->columnSpanFull(),
                ])->collapsed(),

                Section::make(__('form.image'))->schema([
                    SpatieMediaLibraryFileUpload::make('image')
                        ->visibility(true)
                        ->image()
                        ->imageEditor()
                        ->collection('product_image')
                        ->multiple()
                        ->reorderable()
                        ->label(__('form.image')),

                    SpatieMediaLibraryFileUpload::make('img')
                        ->visibility(true)
                        ->image()
                        ->imageEditor()
                        ->collection('product_img')
                        ->label(__('form.img')),

                    SpatieMediaLibraryFileUpload::make('wrapper')
                        ->image()
                        ->imageEditor()
                        ->collection('wrapper')
                        ->label(__('form.wrapper')),
                ])->collapsed()->columns(3),

                Section::make(__('form.history'))->schema([
                    TranslatableTabs::make()
                        ->localeTabSchema(fn(TranslatableTab $tab) => [
                            RichEditor::make($tab->makeName('history'))
                                ->label(__('form.history')),
                        ])->columnSpanFull(),
                    SpatieMediaLibraryFileUpload::make('history_images')
                        ->image()
                        ->imageEditor()
                        ->multiple()
                        ->collection('history_images')
                        ->label(__('form.history_image')),
                ])->collapsed(),

                Section::make('SEO')->schema([
                    TranslatableTabs::make()
                        ->localeTabSchema(fn(TranslatableTab $tab) => [
                            TextInput::make($tab->makeName('seo_title')),
                            Textarea::make($tab->makeName('seo_description')),
                        ])->columnSpanFull(),
                ])->collapsed(),

                TextInput::make('min_days')->numeric()
                    ->label(__('form.min_days')),
                TextInput::make('max_days')->numeric()
                    ->label(__('form.max_days')),
                TextInput::make('amount')->numeric()->step(0.1)
                    ->label(__('form.amount')),
                TextInput::make('price')->numeric()
                    ->label(__('form.price')),

                Toggle::make('home_visibility')
                    ->label(__('form.home_visibility')),

                Select::make('collection_visibility')->options([
                    1 => __('form.collection'),
                    __('form.bestsellers'),
                    __('form.new_collection')
                ])->label(__('form.group'))->nullable(false),

                Select::make('group')
                    ->multiple()
                    ->relationship('groups', 'name')
                    ->options(fn () => GroupTranslation::whereLocale(app()->getLocale())->pluck('name', 'group_id')),

                //Toggle::make('status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(isToggledHiddenByDefault: true),

                SpatieMediaLibraryImageColumn::make('img')->collection('product_img')
                    ->label(__('form.img'))
                    ->toggleable(isToggledHiddenByDefault: true),

                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('product_image')->stacked()->label(__('form.image'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('name')->sortable()->searchable(query: function ($query, $search) {
                    return $query->with('translations')->whereHas('translations', function ($q) use ($search) {
                        return $q->where('name', 'ILIKE', "$search%");
                    });
                })->label(__('form.name')),

                TextColumn::make('categories')->label(__('panel.categories'))
                    ->getStateUsing(function ($record) {
                        $categories = $record->categories->pluck('name')->take(2)->implode(', ');
                        return $categories . ($record->categories->count() > 2 ? '...' : '');
                    })->tooltip(fn($record) => $record->categories->pluck('name')->implode(', '))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextInputColumn::make('price')->sortable()->width(100)->label(__('form.price')),

                TextInputColumn::make('amount')
                    ->sortable()->width(100)->label(__('form.amount'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextInputColumn::make('min_days')
                    ->sortable()->width(50)->label(__('form.min_days'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextInputColumn::make('max_days')
                    ->sortable()->width(50)->label(__('form.max_days'))
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->reorderable('order')
            ->defaultSort('order')
            ->filters([
                //
            ])
            ->actions([

                RelationManagerAction::make('lesson-relation-manager')->label('')->icon('heroicon-s-rectangle-stack')->relationManager(CategoriesRelationManager::make()),
                Tables\Actions\EditAction::make()->label('')
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
            CategoriesRelationManager::class,
            CharacteristicsRelationManager::class,
            TypesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['uz', 'ru', 'en'];
    }

}
