<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Page;
use App\Models\Theme;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\FileUploadTrait;

class ThemeController extends Controller
{
    use FileUploadTrait;
    public function index(Request $request)
    {
      
            $themes = Theme::get();
            return Inertia::render('Theme/Theme', compact('themes'));
       
    }

    public function store(Request $request)
    {

       
            $this->validate($request, [
                'title' => 'required|unique:themes',
                'link_code' => 'required',
                'image_template' => 'required|mimes:png,jpg,jpeg',
                'type' => 'required',


            ]);

            $destinationpath = 'images/theme/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }

            Theme::create([
                'title' => $request->title,
                'link_code' => $request->link_code,
                'image_template' => $this->image($request->file('image_template'), $destinationpath),
                'type' => $request->type
            ]);
            return back()->with('success', 'Create successfully');
       
    }
    public function update(Request $request, $id)
    {

        
            $theme = Theme::findOrFail($id);
            $this->validate($request, [
                'title' => 'required|unique:themes,title,' . $theme->id,
                'link_code' => 'required',
                'image_template' => 'nullable|mimes:png,jpg,jpeg',
                'type' => 'required',


            ]);

            $destinationpath = 'images/theme/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }

            $name = time();
            $theme->update([
                'title' => $request->title,
                'link_code' => $request->link_code,
                'image_template' => $request->hasFile('image_template') ? $this->update_image($request->file('image_template'), $name, $destinationpath, $theme->image_template) : $theme->image_template,
                'type' => $request->type
            ]);
            return back()->with('success', 'Update successfully');
      
    }


    public function delete($id)
    {
       
            $theme = Theme::findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($theme->image_template, $extension);
            $theme->delete();
            return back()->with('success', 'Delete sucussefully');
       
    }

    
}
