<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post; // Replace with your model
use App\Models\Category; // Replace with your model


class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->get();
        $categories = Category::all();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add static URLs
        $xml .= $this->urlElement(url('/'), now()->toAtomString(), 'weekly', '1.0');

        // Add dynamic URLs (e.g., posts)
        foreach ($posts as $post) {
            $xml .= $this->urlElement(route('post.detail', [$post->category->slug,$post->slug]), $post->updated_at->toAtomString(), 'weekly', '0.8');
        }

        // Add dynamic URLs (e.g., categories)
        foreach ($categories as $category) {
            $xml .= $this->urlElement(route('get-article-by-category', $category->slug), $category->updated_at->toAtomString(), 'weekly', '0.8');
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
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
