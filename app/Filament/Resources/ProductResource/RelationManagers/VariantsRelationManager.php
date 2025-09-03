<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VariantsRelationManager extends RelationManager
{

    use ResourceTranslatable;

    protected static string $relationship = 'variants';

    public function form(Form $form): Form
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
                                ->label(__('form.Advantages')),
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

                /*Section::make(__('form.history'))->schema([
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
                ])->collapsed(),*/

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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
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
