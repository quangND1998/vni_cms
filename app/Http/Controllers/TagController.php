<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
       
            $tags = Tag::get();

            return Inertia::render('Blog/Tag', compact('tags'));
     
    }

    public function store(Request $request)
    {

       
            $this->validate(
                $request,
                [
                    'name' => 'required|unique:tags,name|min:2|max:100'

                ],
                [
                    'name.required' => 'Bạn chưa nhập tên Tag!',
                    'name.unique' => 'Tên Tag đã tồn tại, vui lòng nhập lại!',
                    'name.min' => 'Tên Tag gồm ít nhất 3 ký tự!',
                    'name.max' => 'Tên Tag gồm tối đa 100 ký tự!'
                ]
            );
            Tag::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);



            return back()->with('success', 'Create successfully');
      
    }

    public function update(Request $request, $id)
    {
        

            $tag = Tag::findOrFail($id);
            $this->validate(
                $request,
                [
                    'name' => 'required|min:2|max:100|unique:tags,name,' . $tag->id
                ],
                [
                    'name.required' => 'Bạn chưa nhập tên Tag!',
                    'name.unique' => 'Tên Tag đã tồn tại, vui lòng nhập lại!!',
                    'name.min' => 'Tên Tag gồm ít nhất 3 ký tự!',
                    'name.max' => 'Tên Tag gồm tối đa 100 ký tự!'
                ]
            );
            $tag->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            return back()->with('success', 'Create successfully');
       
    }

    public function delete($id)
    {
        
            $tag = Tag::findOrFail($id);

            $tag->delete();
            return back()->with('success', 'Delete successfully');
      
    }
}
