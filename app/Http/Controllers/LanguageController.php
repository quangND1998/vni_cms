<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Languages;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Traits\LanguageTrait;
use Illuminate\Support\Str;
class LanguageController extends Controller
{
    use LanguageTrait;
    public function index(Request $request){
       
            $languages = Languages::when($request->term, function ($query, $term) {
                $query->where('en', 'LIKE', '%' . $term . '%')->orwhere('vn', 'LIKE', '%' . $term . '%')->orwhere('key', 'LIKE', '%' . $term . '%');
            })->paginate(10)->appends(['term' => $request->term]);
            $locales = config('app.locales');
            return Inertia::render('Language',compact('languages','locales'));
  
    }

    public function store(Request $request){
        
            $this->validate(
                $request,
                [
                    'key' => 'required|unique:languages,key',
                    // 'vn' => 'required',
                    // 'en' => 'required',
                ]
            );
            $name =time();
            $language = new Languages();
            $language->key =$request->key;
            $language->vn = $request->vn;
            $language->en = $request->en;
            $language->save();
            $this->saveLanguage($language->key, $language->en, $language->vn);
            $this->saveLanguageApi($language->key, $language->en, $language->vn);
            return back()->with('success', 'Create successfully');
      
    }

    public function update(Request $request,$id){
       
            $this->validate(
                $request,
                [
                    // 'vn' => 'required',
                    // 'en' => 'required',
                ]
            );
            $language= Languages::findOrFail($id);
            $language->vn = $request->vn;
            $language->en = $request->en;
            $language->save();
            $this->saveLanguage($language->key, $language->en, $language->vn);
            $this->saveLanguageApi($language->key, $language->en, $language->vn);
            return back()->with('success', 'Update successfully');
    
        
    }

    public function delete($id){
        $language= Languages::findOrFail($id);
        $this->deleteLanguage($language->key, 'en.json');
        $this->deleteLanguage($language->key, 'vn.json');
        $language->delete();
        return back()->with('success', 'Delete successfully');
    }
}
