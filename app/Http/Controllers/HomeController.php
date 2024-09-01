<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function index(){

        SEOMeta::setTitle('Home - Kem Reaksmey');
        SEOMeta::setDescription('kemreaksmey.com: Explore expert tutorials and resources on web development technologies like HTML, CSS, Bootstrap, TailwindCSS, PHP, Laravel, Livewire, and MySQL to build and enhance your website skills.');
        SEOMeta::setCanonical('https://kemreaksmey.com/');

        OpenGraph::setDescription('kemreaksmey.com: Explore expert tutorials and resources on web development technologies like HTML, CSS, Bootstrap, TailwindCSS, PHP, Laravel, Livewire, and MySQL to build and enhance your website skills.');
        OpenGraph::setTitle('Home - Kem Reaksmey');
        OpenGraph::setUrl('https://kemreaksmey.com/');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('Home - Kem Reaksmey');
        TwitterCard::setSite('@kemreaksmey');

        SEOTools::setTitle('Home - Kem Reaksmey');
        SEOTools::setDescription('kemreaksmey.com: Explore expert tutorials and resources on web development technologies like HTML, CSS, Bootstrap, TailwindCSS, PHP, Laravel, Livewire, and MySQL to build and enhance your website skills.');
        SEOTools::opengraph()->setUrl('https://kemreaksmey.com');
        SEOTools::setCanonical('https://kemreaksmey.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@kemreaksmey');

        return view('front.home');
    }

    public function cookieConsent(){
        return view('front.cookie-consent');
    }

    public function TermsAndPrivacy(){
        return view('front.terms-and-privacy');
    }
}
