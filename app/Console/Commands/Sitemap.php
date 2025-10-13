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
        $d = 'https://ais.uz';

        foreach (['ru', 'en', 'uz'] as $lang) {
            $pages->add(Url::create("$d/$lang/")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("$d/$lang/about")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("$d/$lang/catalog")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("$d/$lang/contact")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("$d/$lang/guarantee")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("$d/$lang/news")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("$d/$lang/rental")->setLastModificationDate(Carbon::yesterday()))
                ->add(Url::create("$d/$lang/catalog")->setLastModificationDate(Carbon::yesterday()));
        }

        Event::all()->each(function (Event $event) use ($pages, $d) {
            foreach (['uz', 'en'] as $lang) {
                $pages->add(Url::create("$d/$lang/news/$event->id")->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)->setPriority(0.8));
            }
        });

        $pages->writeToFile(public_path('pages_sitemap.xml'));

        $sitemap = \Spatie\Sitemap\Sitemap::create();

        Category::all()->each(function (Category $category) use ($sitemap, $d) {
            foreach (['ru', 'uz', 'en'] as $lang) {
                $sitemap->add(
                    Url::create("$d/$lang/catalog/$category->slug")
                        ->setLastModificationDate(Carbon::yesterday())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.8)
                );
                foreach ($category->products as $product) {
                    $sitemap->add(
                        Url::create("$d/$lang/catalog/$category->slug/$product->slug")
                            ->setLastModificationDate(Carbon::yesterday())
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                            ->setPriority(0.8)
                    );
                    foreach ($product->variants as $variant) {
                        $sitemap->add(
                            Url::create("$d/$lang/catalog/$category->slug/$product->slug/$variant->id")
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
