<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class Sitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $pages = \Spatie\Sitemap\Sitemap::create();

        foreach (['ru', 'en', 'uz'] as $lang) {
            $pages->add(Url::create("/$lang/")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("/$lang/about")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("/$lang/catalog")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("/$lang/contact")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("/$lang/guarantee")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("/$lang/news")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("/$lang/rental")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("/$lang/catalog")->setLastModificationDate(Carbon::yesterday()));
        }

        Event::all()->each(function (Event $event) use ($pages) {
            foreach (['uz', 'en'] as $lang) {
                $pages->add(Url::create("/$lang/news/$event->id")->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)->setPriority(0.8));
            }
        });

        $pages->writeToFile(public_path('pages_sitemap.xml'));

        $sitemap = \Spatie\Sitemap\Sitemap::create();

        Category::all()->each(function (Category $category) use ($sitemap) {
            foreach (['ru', 'uz', 'en'] as $lang) {
                $sitemap->add(
                    Url::create("/$lang/catalog/$category->slug")
                        ->setLastModificationDate(Carbon::yesterday())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.8)
                );
                foreach ($category->products as $product) {
                    $sitemap->add(
                        Url::create("/$lang/catalog/$category->slug/$product->slug")
                            ->setLastModificationDate(Carbon::yesterday())
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                            ->setPriority(0.8)
                    );
                    foreach ($product->variants as $variant) {
                        $sitemap->add(
                            Url::create("/$lang/catalog/$category->slug/$product->slug/$variant->id")
                                ->setLastModificationDate(Carbon::yesterday())
                                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                                ->setPriority(0.8)
                        );
                    }
                }
            }
        });


        $sitemap->writeToFile(public_path('products_sitemap.xml'));

        SitemapIndex::create()->add('/pages_sitemap.xml')->add('/products_sitemap.xml')
            ->writeToFile(public_path('sitemap.xml'));
    }
}
