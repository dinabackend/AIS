<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\BoxProduct;
use App\Models\BoxTranslation;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class BoxesRelationManager extends RelationManager
{
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('panel.boxes');
    }

    protected static string $relationship = 'boxes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('price'),
                ImageColumn::make('images')->getStateUsing(function ($record) {

                    $boxProduct = BoxProduct::query()
                        ->where('box_id', $record->box_id)
                        ->where('product_id', $record->product_id)
                        ->first();

                    if ($boxProduct) {
                        return $boxProduct->getMedia('box_images')->map(function ($media) {
                            return $media->getUrl();
                        });
                    } else {return null;}

                })
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->form([
                        Select::make('recordId')->options(BoxTranslation::query()->where('locale', app()
                            ->getLocale())->pluck('name', 'box_id')->all()),

                        TextInput::make('price'),

                        FileUpload::make('images')
                            ->disk('local')
                            ->directory('private/livewire-tmp')
                            ->multiple()
                            ->reorderable()
                    ])
                    ->action(function ($data) {

                        if (isset($data['images']) && count($data['images'])) {

                            /** @var Product $product */
                            $product = $this->getOwnerRecord();

                            $boxProduct = BoxProduct::create([
                                'box_id' => $data['recordId'],
                                'product_id' => $product->id,
                                'price' => $data['price'],
                            ]);

                            if ($boxProduct) {
                                foreach ($data['images'] as $file) {
                                    $filePath = $file instanceof TemporaryUploadedFile
                                        ? storage_path('app/private/' . $file->getFilename())
                                        : storage_path('app/private/' . $file);
                                    $boxProduct->addMedia($filePath)
                                        ->preservingOriginal()
                                        ->toMediaCollection('box_images');
                                }
                            }
                        }
                    })
            ])
            ->actions([
                $this->editAction(),
                DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function editAction(): Action
    {
        return Action::make('edit')
            ->modalHeading('Edit Box Product')
            ->form([
                TextInput::make('price'),
                FileUpload::make('images')
                    ->disk('local')
                    ->directory('private/livewire-tmp')
                    ->multiple()
                    ->reorderable(),
            ])
            ->action(function (Model $record, array $data) {
                if (isset($data['images'])) {
                    $box_product = BoxProduct::query()
                        ->where('box_id', $record->box_id)
                        ->where('product_id', $record->product_id)
                        ->first();
                    if ($box_product->hasMedia('box_images')) {
                        $box_product->clearMediaCollection('box_images');
                    }
                    foreach ($data['images'] as $file) {
                        $filePath = $file instanceof TemporaryUploadedFile
                            ? storage_path('app/private/' . $file->getFilename())
                            : storage_path('app/private/' . $file);
                        $box_product->addMedia($filePath)
                            ->preservingOriginal()
                            ->toMediaCollection('box_images');
                    }

                    if ($box_product->price !== $data['price']) {
                        $box_product->price = $data['price'];
                        $box_product->save();
                    }
                }

            })
            ->fillForm(fn($record) => ['price' => $record->price]);
    }
}
