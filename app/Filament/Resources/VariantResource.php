<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\RelationManagers\CharacteristicsRelationManager;
use App\Filament\Resources\VariantResource\Pages;
use App\Filament\Resources\VariantResource\RelationManagers\BlocksRelationManager;
use App\Filament\Resources\VariantResource\RelationManagers\SectionsRelationManager;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Variant;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
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
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;

class VariantResource extends Resource
{
    public static function getLabel(): ?string
    {
        return __('panel.variant');
    }

    public static function getPluralLabel(): ?string
    {
        return __('panel.variant');
    }
    protected static ?string $model = Variant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Catalog Management';

    protected static ?int $navigationSort = 15;

    public static function getNavigationGroup(): ?string
    {
        return __('panel.catalog_management');
    }

    public static function getNavigationBadge(): ?string
    {
        return Variant::count();
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
                            Textarea::make($tab->makeName('subtitle'))
                                ->rows(3)
                                ->required($tab->makeName('subtitle') === 'uz.subtitle')
                                ->label(__('form.subtitle')),
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

                Section::make(__('form.media'))->schema([

                    SpatieMediaLibraryFileUpload::make('img')
                        ->visibility(true)
                        ->image()
                        ->imageEditor()
                        ->collection('product_img')
                        ->label(__('form.img')),

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
                            TextInput::make($tab->makeName('seo_title')),
                            Textarea::make($tab->makeName('seo_description')),
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

                Toggle::make('home_visibility')
                    ->label(__('form.home_visibility')),

                Select::make('product_id')
                    ->label(__('form.product'))
                    ->required()
                    ->relationship('product', 'name')
                    ->options(fn () => ProductTranslation::whereLocale(app()->getLocale())->pluck('name', 'product_id')->toArray()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(isToggledHiddenByDefault: true),

                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('product_image')->stacked()->label(__('form.img'))
                    ->toggleable(isToggledHiddenByDefault: true),

                SpatieMediaLibraryImageColumn::make('img')->collection('product_img')
                    ->label(__('form.image'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('name')->sortable()->searchable(query: function ($query, $search) {
                    return $query->with('translations')->whereHas('translations', function ($q) use ($search) {
                        return $q->where('name', 'ILIKE', "$search%");
                    });
                })->label(__('form.name')),

                SelectColumn::make('product_id')->options(function () {
                    return ProductTranslation::where('locale', app()->getLocale())->pluck('name', 'product_id')->toArray();
                })->label(__('form.product'))->width(400)->selectablePlaceholder(false),

            ])
            ->filters([
                //
            ])
            ->actions([

                RelationManagerAction::make('characteristics-relation-manager')
                    ->label('')->icon('heroicon-s-adjustments-horizontal')
                    ->tooltip('characteristics')
                    ->relationManager(CharacteristicsRelationManager::make()),

                /*RelationManagerAction::make('sections-relation-manager')
                    ->label('')->icon('heroicon-s-rectangle-group')
                    ->tooltip('sections')
                    ->relationManager(SectionsRelationManager::make()),*/

                Tables\Actions\EditAction::make()->label('')->tooltip('edit'),
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
            CharacteristicsRelationManager::class,
            //SectionsRelationManager::class,
            BlocksRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVariants::route('/'),
            'create' => Pages\CreateVariant::route('/create'),
            'edit' => Pages\EditVariant::route('/{record}/edit'),
        ];
    }
}
