<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use App\Models\Section;
use Inertia\Inertia;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Models\CategoryContent;
use App\Models\Languages;
use App\Jobs\DeleteLanguage;
use Illuminate\Support\Str;
class CategoryContentController extends Controller
{
    use FileUploadTrait, LanguageTrait;
    public function category(Request $request, $slug)
    {
      
            $section = Section::with('category_contents.languages', 'page', 'theme', 'languages')->where('title', $slug)->first();
            if ($section == null) {
                $erros = 404;
                return Inertia::render('Error', ['status' => $erros]);
            }
            $page = $section->page;
            return Inertia::render('Category/Category', compact('section', 'page'));
       
    }


    public function category_getContent(Request $request, $slug)
    {

       
            $category = CategoryContent::with('contents.languages', 'languages', 'section.page', 'contents.images')->where('title', $slug)->first();



            if ($category == null) {
                $erros = 404;
                return Inertia::render('Error', ['status' => $erros]);
            }
            $section = $category->section;
            $page = $section->page;


            return Inertia::render('Category/Content', compact('category', 'section', 'page'));
     
    }


    public function createContentCategory($slug)
    {
       
            $category = CategoryContent::with('contents.languages',  'languages', 'section.page','section.theme')->where('title', $slug)->first();

            if ($category == null) {
                $erros = 404;
                return Inertia::render('Error', ['status' => $erros]);
            }
            $section = $category->section;
            $page = $section->page;

            return Inertia::render('Category/CreateContent', compact('category', 'section', 'page'));
      
    }

    public function editContentCategory($id)
    {
       
            $content = Content::with('languages', 'contentable', 'images')->findOrFail($id);

            $category = $content->contentable;
            $section = $category->section;
            $theme = $section->theme;
            $page = $section->page;
            if ($content == null) {
                $erros = 404;
                return Inertia::render('Error', ['status' => $erros]);
            }
            return Inertia::render('Category/UpdateContent',  compact('category', 'section', 'page', 'content', 'theme'));
      
    }
    public function store(Request $request, $id)
    {
        

            $this->validate(
                $request,
                [
                    'title' => 'required|unique:category_contents',
                    'title_en' => 'required_with:title',
                    'title_vn' => 'required_with:title'
                ]
            );
            $name = time();
            $section = Section::findOrFail($id);
            $category = CategoryContent::create([
                'title' => Str::slug($request->title.$name),
                'section_id' => $section->id
            ]);
            $this->CreateLanguage($category->title, $request->title_en, $request->title_vn, $category);
            $this->storeLanguageApi($category->title, $request->title_en, $request->title_vn);
            return back()->with('success', 'Create successfully');
      
    }

    public function update(Request $request, $id)
    {
       

            $category = CategoryContent::with('languages')->findOrFail($id);
            $language_title = Languages::where('key', $category->title)->first();
            $this->validate(
                $request,
                [
                    'title_en' => 'required_with:title',
                    'title_vn' => 'required_with:title'
                ]
            );

            $this->updateLanguage($category->title, $request->title_en, $request->title_vn, $category);
            $this->updateLanguageApi($category->title, $request->title_en, $request->title_vn);
            return back()->with('success', 'Create successfully');
       
    }
    public function delete($id)
    {
       
            $category = CategoryContent::with('languages')->findOrFail($id);

            foreach ($category->languages as $language) {
                dispatch(new DeleteLanguage($language->key, 'en.json'));
                dispatch(new DeleteLanguage($language->key, 'vn.json'));
            }
            foreach ($category->contents as $content) {
                $extension = " ";
                $this->DeleteFolder($content->image, $extension);
                foreach ($content->languages as $language) {
                    dispatch(new DeleteLanguage($language->key, 'en.json'));
                    dispatch(new DeleteLanguage($language->key, 'vn.json'));
                }
            }
            $category->contents()->delete();
            $category->delete();
            return back()->with('success', 'Delete successfully');
       
    }
}
