<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\City;
use App\Models\Section;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    //show all cities
    public function show_all_cities()
    {
        $cities = City::all();
        // Group query to show some items
        $sections = selectActiveSctions();
        $articles = select5ActiveArticles();
        $first_articles = selectFirst_Articles();
        $last_articles = selectLast_Articles();
        $tags = select10ActiveTags();
        $footer_page_links = FooterPageLinks();        

        return view('front.pages.cities.cities_group', compact('cities','sections','articles','tags','first_articles','last_articles','footer_page_links'));
    }
    //show one city with her all tags
    public function show_one_city($slug)
    {
        $city = City::where('slug', $slug)->first();
        $cityTags = $city->tags()->paginate(PAGINATION_COUNT);
        // return $cityTags;
        // Group query to show some items
        $sections = selectActiveSctions();
        $articles = select5ActiveArticles();
        $first_articles = selectFirst_Articles();
        $last_articles = selectLast_Articles();
        $tags = select10ActiveTags();
        $footer_page_links = FooterPageLinks();        

        return view('front.pages.cities.city', compact('city','sections','articles','tags','first_articles','last_articles','cityTags','footer_page_links'));

    }
    //show one city with his tag
    public function show_city_tag($slug,$city){

        // return $city;

        $city = City::where('slug', $city)->first();

        // Replace hyphen (-) with space( )
        $slugTag_with_city = str_replace("-", " ", $slug);

        // Group query to show some items
        $sections = selectActiveSctions();
        $articles = select5ActiveArticles();
        $first_articles = selectFirst_Articles();
        $last_articles = selectLast_Articles();
        $tags = select10ActiveTags();
        $footer_page_links = FooterPageLinks();        

        
        if (!$city) {
        return redirect()->route('404.index');
        }
        return view('front.pages.cities.city-with-tag', compact('city','slugTag_with_city','sections','articles','tags','first_articles','last_articles','footer_page_links'));


    }
}
