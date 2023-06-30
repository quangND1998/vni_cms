<?php

namespace App\Http\Controllers;

use App\Models\CategoryContent;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\tintuc;
use App\Models\Languages;
use App\Models\Section;
use App\Models\theloai;
use Illuminate\Support\Facades\Redirect ;
class LandingPageController extends Controller
{
    public function index()
    {
        // dd(config('api.API_URL'));
        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();
        $page = Page::with(['sections.contents.images', 'sections.category_contents.contents.images', 'sections.theme','sections'=>function($q){
            $q->where('active',1);
        }])->first();


        $datas = Section::whereHas('page', function ($query) {
            $query->where('title', 'visualization')->orWhere('title', 'virtual-reality');
        })->with('contents.images', 'cate_contents.images', 'page', 'contents')->get();


        if (count($datas) > 0) {
            foreach ($datas as $data) {
                foreach ($data->cate_contents as $content) {
                    $contents[] = $content;
                }
            }
        } else {
            $contents = [];
        }
        $sorted = collect($contents)->sortByDesc('created_at');
        $contents =  $sorted->values();


        $news = tintuc::with('languages', 'theloai', 'tags')->where('NoiBat', 1)->get();



        $pages = Page::orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
        $sections = $page->sections;
        // return $sections;
        return view('landingpage.home', compact('page', 'sections', 'pages', 'header', 'contents', 'news'));
    }

    public function tintuc()
    {
        $page = Page::with(['sections.contents.images', 'sections.category_contents.contents.images', 'sections.theme','sections'=>function($q){
            $q->where('active',1);
        }])->where('title', 'news')->first();
        $pages = Page::orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
        $news = tintuc::with('languages', 'theloai', 'tags')->orderBy('created_at', 'desc')->take(6)->get();

        return view('landingpage.news', compact('page', 'pages', 'news'));
    }

    public function visualization()
    {

        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();
        $pages = Page::orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
        $visual = Page::with(['sections.contents.images', 'sections.cate_contents', 'sections.category_contents.contents.images', 'sections.theme' ,'sections'=>function($q){
            $q->where('active',1);
        }])->where('title', 'visualization')->first();

        return view('landingpage.visualization', compact('pages', 'visual', 'header'));
    }

    public function virtual_reality()
    {
        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();

        $pages = Page::orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
        $visual = Page::with(['sections.contents.images', 'sections.cate_contents', 'sections.languages', 'sections.category_contents.contents.images', 'sections.theme','sections'=>function($q){
            $q->where('active',1);
        }])->where('title', 'virtual-reality')->first();
        return view('landingpage.virtual_reality', compact('pages', 'visual', 'header'));
    }


    public function contact()
    {
        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();
        $pages = Page::orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
        $page = Page::with(['sections.contents.images', 'sections.category_contents.contents.images', 'sections.theme','sections'=>function($q){
            $q->where('active',1);
        }])->where('title', 'contact')->first();
        $sections = $page->sections;
        return view('landingpage.contact', compact('pages', 'sections', 'header'));
    }
    public function visualization_preview(Request $request, $slug)
    {
        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();
        $pages = Page::orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();

        $language = Languages::where('en', $slug)->orWhere('vn', $slug)->first();
        if ($language) {
            $content = Content::with('images')->findOrFail($language->languageable->id);
            if (count($content->images) < 2 && $content->link != null) {
                return  Redirect::to($content->link);
            }else{
                return view('landingpage.product_image_video_tour', compact('pages', 'content', 'header'));
            }
        } else {

            return view('landingpage.not-found', compact('pages', 'header'));
        }
    }



    public function chitiet_tintuc(Request $request, $slug)
    {
        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();
        $pages = Page::orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
        $number_all = tintuc::count();
        $theloais = theloai::withCount('tintucs')->get();

        $language = Languages::where('en', $slug)->orWhere('vn', $slug)->first();
        if ($language) {
            $tintuc = tintuc::with('theloai', 'tags')->findOrFail($language->languageable->id);
            $tintuc_lienquan =  tintuc::with('theloai', 'tags')->where('idTheloai', $tintuc->theloai->id)->where('TieuDe', '!=', $tintuc->TieuDe)->take(3)->get();
            if ($tintuc) {
                return view('landingpage.detail', compact('pages', 'tintuc', 'tintuc_lienquan', 'number_all', 'theloais', 'header'));
            }
        } else {

            return view('landingpage.not-found', compact('pages', 'header'));
        }
    }

    public function chitiet_content_tintuc(Request $request, $slug)
    {
        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();
        $pages = Page::orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();


        $language = Languages::where('en', $slug)->orWhere('vn', $slug)->first();

        if ($language) {
            $content = Content::with('images')->findOrFail($language->languageable->id);


            if ($content) {
                return view('landingpage.content_tintuc', compact('pages', 'content', 'header'));
            }
        } else {

            return view('landingpage.not-found', compact('pages', 'header'));
        }
    }
}
