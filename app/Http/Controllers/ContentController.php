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
use App\Models\Images;
use App\Models\Languages;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    use FileUploadTrait, LanguageTrait;
    public function index(Request $request, $slug)
    {


        $section = Section::with('contents.languages', 'page', 'theme', 'languages', 'contents.images')->where('title', $slug)->first();



        if ($section == null) {
            $erros = 404;
            return Inertia::render('Error', ['status' => $erros]);
        }
        $page = $section->page;

        return Inertia::render('Content/Content', compact('section', 'page'));
    }

    public function all()
    {
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
        // return $contents ;

        $sorted = collect($contents)->sortBy('id_priority');
        $contents =  $sorted->values();
        return Inertia::render('Content/GetAll', compact('contents'));
    }









    public function createContent($slug)
    {

        $section = Section::with('contents.languages', 'page', 'theme', 'theme', 'languages')->where('title', $slug)->first();



        if ($section == null) {
            $erros = 404;
            return Inertia::render('Error', ['status' => $erros]);
        }
        $page = $section->page;

        return Inertia::render('Content/CreateContent', compact('section', 'page'));
    }





    public function edit($id)
    {

        $content = Content::with('languages', 'contentable', 'images')->findOrFail($id);

        $section = $content->contentable;
        // $section = $section->with('theme', 'page');
        $page = $section->page;
        $theme = $section->theme;

        if ($content == null) {
            $erros = 404;
            return Inertia::render('Error', ['status' => $erros]);
        }

        return Inertia::render('Content/UpdateContent', compact('content', 'section', 'page'));
    }

    public function store(Request $request, $id)
    {

        $section = Section::findOrFail($id);
        $name = time();

        $this->validate(
            $request,
            [
                'title_en' => 'required',
                'title_vn' => 'required',
                'description_en' => 'nullable',
                'description_vn' => 'nullable',
                'link' => 'nullable',
                'video' => 'nullable',
                'images.*' => 'nullable|mimes:png,jpg,jpeg,svg',
                'icon' => 'nullable|mimes:jepg,jpg,png,svg,webp'

            ],
            [
                'title_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
                'title_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
                'title_en.unique' => __('Bài viết  bằng Tiếng Anh đã tồn tại'),
                'title_vn.unique' => __('Bài viết bằng Tiếng Việt đã tồn tại'),
            ]
        );

        $destinationpath = 'images/contents/';
        if (!file_exists($destinationpath)) {
            mkdir($destinationpath, 0777, true);
        }

        // $content = Content::create([
        //     'title' => 'title' . $name,
        //     'description' => 'description' . $name,
        //     'sub_title' => 'sub_title' . $name,
        //     'link' => $request->link,
        //     'video' => $request->video,
        //     'image' => $request->hasFile('icon') ? $this->image($request->file('icon'), $destinationpath) : null,
        // ]);

        $content = new Content();
        $content->title = 'title' . $name;
        $content->description = 'description' . $name;
        $content->sub_title =  'sub_title' . $name;
        $content->link = $request->link;
        $content->video = $request->video;
        $content->image = $request->hasFile('icon') ? $this->image($request->file('icon'), $destinationpath) : null;
        $section->contents()->save($content);
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
        $sub_code = $content->id . Str::random(10);
        $this->CreateLanguage($content->title, $request->title_en, $request->title_vn, $content);
        $this->CreateLanguage($content->description, $request->description_en, $request->description_vn, $content);
        $this->CreateLanguage($content->sub_title, Str::slug($request->title_en) . '-' . $sub_code, Str::slug($request->title_vn) . '-' . $sub_code, $content);

        $this->storeLanguageApi($content->title, $request->title_en, $request->title_vn);
        $this->storeLanguageApi($content->description, $request->description_en, $request->description_vn);
        $this->storeLanguageApi($content->sub_title, Str::slug($request->title_en) . '-' . $sub_code, Str::slug($request->title_vn) . '-' . $sub_code);
        return redirect('/admin/pages/section/' . $section->title . '/content')->with('success', 'Create successfully');
    }


    public function category_store(Request $request, $id)
    {


        $category = CategoryContent::findOrFail($id);
        $name = time();
        $this->validate(
            $request,
            [
                'title_en' => 'required',
                'title_vn' => 'required',
                'description_en' => 'nullable',
                'description_vn' => 'nullable',
                'link' => 'nullable',
                'video' => 'nullable',
                'images.*' => 'nullable|mimes:png,jpg,jpeg,svg',
                'icon' => 'nullable|mimes:png,svg,webp'

            ],
            [
                'title_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
                'title_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
                'title_en.unique' => __('Bài viết  bằng Tiếng Anh đã tồn tại'),
                'title_vn.unique' => __('Bài viết bằng Tiếng Việt đã tồn tại'),
            ]
        );
        $destinationpath = 'images/contents/';
        if (!file_exists($destinationpath)) {
            mkdir($destinationpath, 0777, true);
        }
        // $content = Content::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'sub_title' => $request->sub_title,
        //     'link' => $request->link,
        //     'video' => $request->video,
        //     'image' => $request->hasFile('image') ?$this->image($request->file('image'), $destinationpath):null,
        // ]);
        $content = new Content();
        $content->title = 'title' . $name;
        $content->description = 'description' . $name;
        $content->sub_title =  'sub_title' . $name;
        $content->link = $request->link;
        $content->video = $request->video;
        $content->image = $request->hasFile('icon') ? $this->image($request->file('icon'), $destinationpath) : null;
        $category->contents()->save($content);
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
        $sub_code = $content->id . Str::random(10);
        $this->CreateLanguage($content->title, $request->title_en, $request->title_vn, $content);
        $this->CreateLanguage($content->description, $request->description_en, $request->description_vn, $content);
        $this->CreateLanguage($content->sub_title, Str::slug($request->title_en) . '-' . $sub_code, Str::slug($request->title_vn) . '-' . $sub_code, $content);


        $this->updateLanguageApi($content->title, $request->title_en, $request->title_vn);
        $this->updateLanguageApi($content->description, $request->description_en, $request->description_vn);
        $this->updateLanguageApi($content->sub_title, Str::slug($request->title_en) . '-' . $sub_code, Str::slug($request->title_vn) . '-' . $sub_code);

        return redirect('/admin/pages/section/' . $category->title . '/category/contents')->with('success', 'Create successfully');
    }


    public function update(Request $request, $id)
    {


        $content = Content::with('languages', 'contentable')->findOrFail($id);
        $language_title = Languages::where('key', $content->title)->first();
        $language_sub_title = Languages::where('key', $content->sub_title)->first();
        $language_description = Languages::where('key', $content->description)->first();

        $this->validate(
            $request,
            [
                'title_en' => 'required',
                'title_vn' => 'required',
                'subtitle_en' => 'nullable',
                'subtitle_vn' => 'nullable',
                'description_en' => 'nullable',
                'description_vn' => 'nullable',
                'link' => 'nullable',
                'video' => 'nullable',
                'icon' => 'nullable|mimes:png,svg,webp'
            ]
        );
        $destinationpath = 'images/contents/';
        if (!file_exists($destinationpath)) {
            mkdir($destinationpath, 0777, true);
        }

        $name = time();

        $content->link = $request->link;
        $content->video = $request->video;
        $content->image = $request->hasFile('icon') ? $this->update_image($request->file('icon'), $name, $destinationpath, $content->image) : $content->image;
        $content->save();

        $this->updateLanguage($content->title, $request->title_en, $request->title_vn, $content);
        $this->updateLanguageApi($content->title, $request->title_en, $request->title_vn);
        $sub_code = $content->id . Str::random(10);
        //Cập nhật khi thay đổi title 
        if ($language_title->en !== $request->title_en || $language_title->vn !== $request->title_vn) {
            $this->updateLanguage($content->sub_title, Str::slug($request->title_en) . '-' . $sub_code, Str::slug($request->title_vn) . '-' . $sub_code, $content);
            $this->updateLanguageApi($content->sub_title, Str::slug($request->title_en) . '-' . $sub_code, Str::slug($request->title_vn) . '-' . $sub_code);
        }
        $this->updateLanguage($content->description, $request->description_en, $request->description_vn, $content);

        $this->updateLanguageApi($content->description, $request->description_en, $request->description_vn);


        if ($content->contentable_type === 'App\Models\CategoryContent') {

            return redirect('/admin/pages/section/' . $content->contentable->title . '/category/contents')->with('success', 'Update successfully');
        } else {

            return redirect('/admin/pages/section/' . $content->contentable->title . '/content')->with('success', 'Update successfully');
        }
    }
    public function delete($id)
    {

        $content = Content::with('languages')->findOrFail($id);
        $extension = " ";
        $this->DeleteFolder($content->image, $extension);
        foreach ($content->languages as $language) {
            $this->deleteLanguage($language->key, 'en.json');
            $this->deleteLanguage($language->key, 'vn.json');
            $this->deleteLanguageApi($language->key, 'en.json');
            $this->deleteLanguageApi($language->key, 'vn.json');
        }
        $content->languages()->delete();
        $content->delete();
        return back()->with('success', 'Delete sucussefully');
    }

    public function priorityContent(Request $request)
    {

        $data = $request->data;
        for ($i = 0; $i < count($data); $i++) {
            Content::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
        }
        return redirect()->back()->with('success', 'Sort  successfully');
    }
}
