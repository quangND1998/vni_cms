<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Page;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Models\Languages;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use App\Models\Permissions;
class PageController extends Controller
{
    use LanguageTrait;
    public function index()
    {
        
            $user= Auth::user();
           
            $pages = Page::with('languages')->orderBy('id_priority','asc')->orderBy('id','asc')->get();
            // return $pages;
            return Inertia::render('Page', compact('pages'));
       
    }

    public function store(Request $request)
    {
     
            $this->validate(
                $request,
                [
                    'title' => 'required|unique:pages,title|unique:languages,key',
                    'description' => 'nullable|unique:languages,key',
                    'description_en' => 'required_with:description',
                    'description_vn' => 'required_with:description',
                    'title_en' => 'required_with:title',
                    'title_vn' => 'required_with:title'
                ]
            );
            $page = Page::create([
                'title' => $request->title,
                'description' => 'description' . time()
            ]);
            $this->CreateLanguage($page->title, $request->title_en, $request->title_vn, $page);
            $this->CreateLanguage($page->description, $request->description_en, $request->description_vn, $page);
            $this->storeLanguageApi($page->title, $request->title_en, $request->title_vn);
            $this->storeLanguageApi($page->description, $request->description_en, $request->description_vn);
            return back()->with('success', 'Create successfully');
      
    }

    public function update(Request $request, $id)
    {
      
            $page = Page::with('languages')->findOrFail($id);
            $language= Languages::where('key', $page->description)->first();
            
            $language_title = Languages::where('key', $page->title)->first();
            $language_description = Languages::where('key', $page->description)->first();
            $this->validate(
                $request,
                [
                    // 'title' => 'required|unique:languages,key,' . $language_title->id,
                    'description_en' => 'nullable',
                    'description_vn' => 'nullable',
                    'title_en' => 'required',
                    'title_vn' => 'required'
                ],
                [
                    'title_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
                    'title_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
                ]

            );
           
            $this->updateLanguage($page->title, $request->title_en, $request->title_vn, $page);
            $this->updateLanguage($page->description, $request->description_en, $request->description_vn, $page);
            $this->updateLanguageApi($page->title, $request->title_en, $request->title_vn);
            $this->updateLanguageApi($page->description, $request->description_en, $request->description_vn);



            return back()->with('success', 'Update successfully');
     
    }

    public function delete($id)
    {
        
            $page = Page::with('languages')->findOrFail($id);
            foreach ($page->languages as $language) {
                $this->deleteLanguage($language->key, 'en.json');
                $this->deleteLanguage($language->key, 'vn.json');

                $this->deleteLanguageApi($language->key, 'en.json');
                $this->deleteLanguageApi($language->key, 'vn.json');
            }
            $page->languages()->delete();
            $page->delete();


            return back()->with('success', 'Update successfully');
        
    
    }

    public function priorityPage(Request $request)
    {
        
            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                Page::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
      
    }
}
