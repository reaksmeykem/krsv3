<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the XML sitemap';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $posts = Post::where('status', 1)->get();
        $categories = Category::all();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add static URLs
        $xml .= $this->urlElement(url('/'), now()->toAtomString(), 'weekly', '1.0');

        // Add dynamic URLs (e.g., posts)
        foreach ($posts as $post) {
            $xml .= $this->urlElement(route('postDetail', [$post->category->slug,$post->slug]), $post->updated_at->toAtomString(), 'weekly', '0.8');
        }

        // Add dynamic URLs (e.g., categories)
        foreach ($categories as $category) {
            $xml .= $this->urlElement(route('getPostByCategory', $category->slug), $category->updated_at->toAtomString(), 'weekly', '0.8');
        }

        $xml .= '</urlset>';

        Storage::put('public/sitemap.xml', $xml);

        $this->info('Sitemap generated successfully!');
    }

    private function urlElement($url, $lastmod, $changefreq, $priority)
    {
        return "<url>
                    <loc>{$url}</loc>
                    <lastmod>{$lastmod}</lastmod>
                    <changefreq>{$changefreq}</changefreq>
                    <priority>{$priority}</priority>
                </url>";
    }
}
