<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Page;
use Inertia\Inertia;
use App\Models\Section;
use App\Models\Theme;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Models\Languages;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Jobs\DeleteLanguage;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
class SectionController extends Controller
{
    use LanguageTrait, FileUploadTrait;
    public function index(Request $request, $id)
    {
      
            $page = Page::with('sections.languages', 'sections.theme')->findOrFail($id);
            $themes = Theme::get();
            $sections = $page->sections;
            return Inertia::render('Section/Section', compact('page', 'themes', 'sections'));
      
    }
    public function edit(Request $request, $id)
    {
      
            $section = Section::with('languages')->findOrFail($id);
            $page = Page::findOrFail($section->page_id);
            $themes = Theme::get();
            return Inertia::render('Section/UpdateSection', compact('page', 'themes', 'section'));
      
    }

    public function create(Request $request, $id)
    {
        
            $page = Page::with('sections.languages', 'sections.theme')->findOrFail($id);
            $themes = Theme::get();
            $sections = $page->sections;
            return Inertia::render('Section/SectionCreate', compact('page', 'themes', 'sections'));
        
    }

    public function store(Request $request, $id)
    {
        

            $page = Page::findOrFail($id);

            $this->validate(
                $request,
                [

                    'title_en' => 'required',
                    'title_vn' => 'required',
                    'description_en' => 'nullable',
                    'description_vn' => 'nullable',
                    'sub_title_en' => 'nullable',
                    'sub_title_vn' => 'nullable',
                    'theme_id' => 'required',

                ]
            );
            $name = time();
            $section = Section::create([
                'title' => 'title' . $name,
                'description' => 'description' . $name,
                'theme_id' => $request->theme_id,
                'sub_title' => 'sub_title' . $name,
                'page_id' => $page->id
            ]);
            $this->CreateLanguage($section->title, $request->title_en, $request->title_vn, $section);
            $this->CreateLanguage($section->description, $request->description_en, $request->description_vn, $section);
            $this->CreateLanguage($section->sub_title, $request->sub_title_en, $request->sub_title_vn, $section);

            $this->storeLanguageApi($section->title, $request->title_en, $request->title_vn);
            $this->storeLanguageApi($section->description, $request->description_en, $request->description_vn);
            $this->storeLanguageApi($section->sub_title, $request->sub_title_en, $request->sub_title_vn);

            return redirect('/admin/pages/' . $page->id . '/section')->with('success', 'Create successfully');
     
    }


    public function update(Request $request, $id)
    {
        
            $section = Section::with('languages')->findOrFail($id);
            $this->validate(
                $request,
                [

                    'title_en' => 'required',
                    'title_vn' => 'required',
                    'description_en' => 'nullable',
                    'description_vn' => 'nullable',
                    'sub_title_en' => 'nullable',
                    'sub_title_vn' => 'nullable',
                    'theme_id' => 'required',

                ]
            );
            $section->theme_id = $request->theme_id;
            $section->save();
            $this->updateLanguage($section->title, $request->title_en, $request->title_vn, $section);
            $this->updateLanguage($section->sub_title, $request->sub_title_en, $request->sub_title_vn, $section);
            $this->updateLanguage($section->description, $request->description_en, $request->description_vn, $section);

            $this->updateLanguageApi($section->title, $request->title_en, $request->title_vn);
            $this->updateLanguageApi($section->description, $request->description_en, $request->description_vn);
            $this->updateLanguageApi($section->sub_title, $request->sub_title_en, $request->sub_title_vn);

            return redirect('/admin/pages/' . $section->page->id . '/section')->with('success', 'Update successfully');
      
    }

    public function delete($id)
    {
       
            $section = Section::with('languages', 'contents.languages', 'category_contents.contents.languages', 'category_contents.languages')->findOrFail($id);

            foreach ($section->contents as $content) {
                $extension = " ";
                $this->DeleteFolder($content->image, $extension);
                foreach ($content->languages as $language) {
                    dispatch(new DeleteLanguage($language->key, 'en.json'));
                    dispatch(new DeleteLanguage($language->key, 'vn.json'));
                }
            }
            foreach ($section->category_contents as $cate) {

                foreach ($cate->languages as $language) {
                    dispatch(new DeleteLanguage($language->key, 'en.json'));
                    dispatch(new DeleteLanguage($language->key, 'vn.json'));
                }
                foreach ($cate->contents as $content) {

                    $this->DeleteFolder($content->image, $extension);
                    foreach ($content->languages as $language) {
                        dispatch(new DeleteLanguage($language->key, 'en.json'));
                        dispatch(new DeleteLanguage($language->key, 'vn.json'));
                    }
                }
            }
            $section->contents()->delete();
            foreach ($section->category_contents as $cate) {
                $cate->contents()->delete();
            }
            $section->delete();


            return back()->with('success', 'Update successfully');
      
    }


    public function prioritySection(Request $request)
    {
      
            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                Section::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
      
    }

    public function changeActive(Request $request){
        
            Section::findOrFail($request->id)->update(['active' => $request->active]);
            return response()->json('Change successfully', Response::HTTP_OK);
     
    }
}
