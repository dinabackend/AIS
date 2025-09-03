<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\BlocksRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\CharacteristicsRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\VariantsRelationManager;
use App\Models\CategoryTranslation;
use App\Models\Product;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
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

    protected static ?string $navigationGroup = 'Catalog Management';

    protected static ?int $navigationSort = 10;

    public static function getNavigationGroup(): ?string
    {
        return __('panel.catalog_management');
    }

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
                            Textarea::make($tab->makeName('description'))
                                ->rows(10)
                                ->required($tab->makeName('description') === 'uz.description')
                                ->label(__('form.description')),
                            Textarea::make($tab->makeName('advantages'))
                                ->rows(10)
                                ->required($tab->makeName('advantages') === 'uz.advantages')
                                ->label(__('form.advantages')),
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

                    SpatieMediaLibraryFileUpload::make('video')
                        ->visibility(true)
                        ->imageEditor()
                        ->collection('product_video')
                        ->label(__('form.video')),

                    /*SpatieMediaLibraryFileUpload::make('wrapper')
                        ->image()
                        ->imageEditor()
                        ->collection('wrapper')
                        ->label(__('form.wrapper')),*/
                ])->collapsed()->columns(3),

                Section::make('SEO')->schema([
                    TranslatableTabs::make()
                        ->localeTabSchema(fn(TranslatableTab $tab) => [
                            TextInput::make($tab->makeName('seo_title'))
                                ->label(__('form.title')),
                            Textarea::make($tab->makeName('seo_description'))
                            ->label(__('form.description')),
                        ])->columnSpanFull(),
                ])->collapsed(),

                Section::make(__('panel.characteristics'))->schema([
                    SpatieMediaLibraryFileUpload::make('RU')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xlsx'])
                        ->collection('product_sheet_ru')
                        ->visibility('private')
                        ->downloadable()
                        ->previewable(false)
                        ->customProperties(fn ($get) => [
                            'language' => 'ru',
                            'header_rows' => $get('ru_header_rows') ?? 1,
                            'file_type' => 'characteristics'
                        ])
                        ->label('RU Excel File'),

                    TextInput::make('ru_header_rows')
                        ->numeric()
                        ->minValue(1)
                        ->label('RU Header Rows Count'),

                    SpatieMediaLibraryFileUpload::make('UZ')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xlsx'])
                        ->collection('product_sheet_uz')
                        ->visibility('private')
                        ->downloadable()
                        ->previewable(false)
                        ->customProperties(fn ($get) => [
                            'language' => 'uz',
                            'header_rows' => $get('uz_header_rows') ?? 1,
                            'file_type' => 'characteristics'
                        ])
                        ->label('UZ Excel File'),

                    TextInput::make('uz_header_rows')
                        ->numeric()
                        ->minValue(1)
                        ->label('UZ Header Rows Count'),

                    SpatieMediaLibraryFileUpload::make('En')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xlsx'])
                        ->collection('product_sheet_en')
                        ->visibility('private')
                        ->downloadable()
                        ->previewable(false)
                        ->customProperties(fn ($get) => ['header_rows' => $get('en_header_rows') ?? 1])
                        ->label('EN Excel File'),

                    TextInput::make('en_header_rows')
                        ->numeric()
                        ->minValue(1)
                        ->label('EN Header Rows Count'),
                ])->columns(2)->collapsed(),

                Select::make('categories')->multiple()->label(__('form.category'))
                    ->relationship('categories', 'name')
                    ->options(fn () => CategoryTranslation::whereLocale(app()->getLocale())->pluck('name', 'category_id')->toArray()),

                Select::make('type')->options([
                    'product' => __('form.product'),
                    'spare_part' => __('form.spare_part'),
                ])->required()->default('product'),

                Toggle::make('home_visibility')->label(__('form.home_visibility')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(isToggledHiddenByDefault: true),

                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('product_image')->stacked()->label(__('form.image'))
                    ->toggleable(isToggledHiddenByDefaroductult: true),

                SpatieMediaLibraryImageColumn::make('img')->collection('product_img')
                    ->label(__('form.img'))
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
            ])
            ->reorderable('order')
            ->defaultSort('order')
            ->filters([
                //
            ])
            ->actions([
                RelationManagerAction::make('variants-relation-manager')->label('')->icon('heroicon-s-squares-2x2')->relationManager(VariantsRelationManager::make()),
                RelationManagerAction::make('category-relation-manager')->label('')->icon('heroicon-s-rectangle-stack')->relationManager(CategoriesRelationManager::make()),
                RelationManagerAction::make('characteristics-relation-manager')->label('')->icon('heroicon-s-adjustments-horizontal')->relationManager(CharacteristicsRelationManager::make()),
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
        //CategoriesRelationManager::class,
        //TypesRelationManager::class,
        return [
            CharacteristicsRelationManager::class,
            VariantsRelationManager::class,
            BlocksRelationManager::class
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
