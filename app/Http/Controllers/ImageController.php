<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Images;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    use FileUploadTrait;
    public function store(Request $request, $id)
    {
       
            $content = Content::findOrFail($id);

            $this->validate(
                $request,
                [
                    'images.*' => 'required|mimes:png,jpg,jpeg',
                ]
            );
            $destinationpath = 'images/contents/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }
            if ($request->hasFile('images')) {
                $files = $request->images;

                foreach ($files as $file) {
                    Images::create([
                        'name' => $file->getClientOriginalName(),
                        'image' => $this->image($file, $destinationpath),
                        'content_id' => $content->id
                    ]);
                }
            }
            return back()->with('success', 'Create successfully');
       
    }
    public function list_image(Request $request, $id)
    {
       
            $content = Content::findOrFail($id);

            $data = $content->contentable;
            if ($data->page_id == null) {
                $section = $data->section;
            } else {
                $section = $data;
            }
            $page = $section->page;
            $theme = $section->theme;
            if ($content == null) {
                return $this->errors()->errors_404();
            }
            $list_image = Images::where('content_id', $id)->orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
            return Inertia::render('Image/ListImage', compact('content', 'list_image', 'section', 'page'));
        
    }


    public function update(Request $request, $id)
    {
      
            $image = Images::findOrFail($id);

            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'images' => 'nullable|mimes:png,jpg,jpeg',
                ]
            );
            $name = time();
            $destinationpath = 'images/contents/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }
            $image->update([
                'name' => $request->name,
                'image' =>  $request->hasFile('images') ? $this->update_image($request->file('images'), $name, $destinationpath, $image->image) : $image->image,
            ]);

            return back()->with('success', 'Update successfully');
      
    }

    public function delete($id)
    {
       
            $image = Images::findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($image->image, $extension);
            $image->delete();
            return redirect()->back()->with('success', 'Delete  successfully');
     
    }


    public function priorityImage(Request $request)
    {
       
            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                Images::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
      
    }

    public function selectElement(Request $request)
    {

       

            Images::find($request->id)->update(['element' => $request->element]);
            return response()->json('Change successfully', Response::HTTP_OK);
    
    }

    public function selectEmbed(Request $request)
    {

       

            Images::find($request->id)->update(['embed' => $request->embed]);
            return response()->json('Change successfully', Response::HTTP_OK);
 
    }
}
