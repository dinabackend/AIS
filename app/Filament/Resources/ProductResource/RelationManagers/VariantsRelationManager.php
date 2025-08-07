<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\ProductTranslation;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VariantsRelationManager extends RelationManager
{
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
