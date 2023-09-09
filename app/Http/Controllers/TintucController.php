<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tintuc;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Models\theloai;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Models\Languages;
use Illuminate\Support\Facades\Auth;

class TintucController extends Controller
{
    use FileUploadTrait, LanguageTrait;
    public function index(Request $request)
    {
       
            $news = tintuc::whereHas('languages', function ($query) use ($request) {
                $query->where('en', 'LIKE', '%' . $request->term . '%')->orwhere('vn', 'LIKE', '%' .  $request->term . '%')->orwhere('key', 'LIKE', '%' .  $request->term . '%');
            })->with(['theloai', 'tags', 'languages' => function ($q) use ($request) {

                $q->where('en', 'LIKE', '%' . $request->term . '%')->orwhere('vn', 'LIKE', '%' .  $request->term . '%')->orwhere('key', 'LIKE', '%' .  $request->term . '%');
            }])->paginate(5)->appends(['term' => $request->term]);
            $theloais = theloai::get();
            $tags = Tag::get();
            return Inertia::render('Blog/Tintuc', compact('news', 'theloais', 'tags'));
      
    }


    public function create()
    {
        
            $theloais = theloai::get();
            $tags = Tag::get();

            return Inertia::render('Blog/CreateNew', compact('theloais', 'tags'));
      
    }

    public function edit($id)
    {
        
            $tintuc = tintuc::with('languages', 'tags')->findOrFail($id);
            $theloais = theloai::get();
            $tags = Tag::get();

            return Inertia::render('Blog/UpdateNew', compact('theloais', 'tags', 'tintuc'));
       
    }
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'TieuDe_en' => 'required|unique:languages,en',
                'TieuDe_vn' => 'required|unique:languages,vn',
                'NoiDung_en' => 'required',
                'NoiDung_vn' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg',
                'NoiBat' => 'required',
                'tags' => 'required',
                'idTheLoai' => 'required'


            ],
            [
                'TieuDe_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
                'TieuDe_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
                'NoiDung_en.required' => __('Hãy nhập nội dung tin tức Tiếng Anh'),
                'NoiDung_vn.required' => __('Hãy nhập nội dung tin tức  Tiếng Việt'),
                'category_id.required' => __('Hãy chọn Thể loại cho tin tức'),
                'NoiBat.required' => __('Hãy chọn tin tức có nổi bật hay không?'),
                'image.required' => __('Hãy Thêm ảnh cho tin tức'),
                'tags.required' => __('Hãy chọn tags cho tin tức'),
            ]
        );
        $destinationpath = 'images/tintuc/';
        if (!file_exists($destinationpath)) {
            mkdir($destinationpath, 777, true);
        }
        $name = time();
        $tintuc = tintuc::create([
            'TieuDe' => 'TieuDe' . $name,
            'TieuDeKhongDau' => 'TieuDeKhongDau'. $name,
            'NoiDung' => 'NoiDung'. $name,
            'Hinh' => $request->hasFile('image') ? $this->image($request->file('image'), $destinationpath) : null,
            'idTheLoai' => $request->idTheLoai,
            'NoiBat' => $request->NoiBat,

        ]);
        $tags = Tag::find($request->tags);
        $tintuc->tags()->sync($tags);
        $this->CreateLanguage($tintuc->TieuDe, $request->TieuDe_en, $request->TieuDe_vn, $tintuc);
        $this->CreateLanguage($tintuc->NoiDung, $request->NoiDung_en, $request->NoiDung_vn, $tintuc);
        $this->CreateLanguage($tintuc->TieuDeKhongDau, Str::slug($request->TieuDe_en), Str::slug($request->TieuDe_vn), $tintuc);

        $this->storeLanguageApi($tintuc->TieuDe, $request->TieuDe_en, $request->TieuDe_vn);
        $this->storeLanguageApi($tintuc->NoiDung, $request->NoiDung_en, $request->NoiDung_vn);
        $this->storeLanguageApi($tintuc->TieuDeKhongDau, Str::slug($request->TieuDe_en), Str::slug($request->TieuDe_vn));
        return redirect('/admin/blogs/tintuc')->with('success', 'Create successfully');
    }

    public function update(Request $request, $id)
    {
       
            $tintuc = tintuc::with('languages')->findOrFail($id);
            $language_title = Languages::where('key', $tintuc->TieuDe)->first();

            $this->validate(
                $request,
                [
                    
                    'TieuDe_en' =>  'required',
                    'TieuDe_vn' => 'required',
                    'NoiDung_en' => 'required',
                    'NoiDung_vn' => 'required',
                    'image' => 'nullable|mimes:jpeg,jpg,png,',
                    'NoiBat' => 'required',
                    'tags' => 'required',
                    'idTheLoai' => 'required'

                ],
                [
                    'TieuDe_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
                    'TieuDe_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
                    'NoiDung_en.required' => __('Hãy nhập nội dung tin tức Tiếng Anh'),
                    'NoiDung_vn.required' => __('Hãy nhập nội dung tin tức  Tiếng Việt'),
                    'NoiBat.required' => __('Hãy chọn tin tức có nổi bật hay không?'),
                    'image.required' => __('Hãy Thêm ảnh cho tin tức'),
                    'tags.required' => __('Hãy chọn tags cho tin tức'),
                    'idTheLoai.required' => _('Hãy chọn thể loại cho tin tức')
                ]
            );
            $destinationpath = 'images/tintuc/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 777, true);
            }

            $name = time();

            $tintuc->update([
                'Hinh' =>  $request->hasFile('image') ? $this->update_image($request->file('image'), $name, $destinationpath, $tintuc->Hinh) : $tintuc->Hinh,
                'idTheLoai' => $request->idTheLoai,
                'NoiBat' => $request->NoiBat,

            ]);
            $tags = Tag::find($request->tags);
            $tintuc->tags()->sync($tags);
            $tintuc->save();
            $sub_code = $tintuc->id.Str::random(10);
            $this->updateLanguage($tintuc->TieuDe, $request->TieuDe_en, $request->TieuDe_vn, $tintuc);
            $this->updateLanguage($tintuc->NoiDung, $request->NoiDung_en, $request->NoiDung_vn, $tintuc);
            if($language_title->en !== $request->TieuDe_en || $language_title->vn !== $request->TieuDe_vn)
            {
                $this->updateLanguage($tintuc->TieuDeKhongDau, Str::slug($request->TieuDe_en).'-'.$sub_code, Str::slug($request->title_vn).'-'.$sub_code, $tintuc);
                $this->updateLanguageApi($tintuc->TieuDeKhongDau, Str::slug($request->TieuDe_en).'-'.$sub_code, Str::slug($request->title_vn).'-'.$sub_code);
            }
            else{
                $this->updateLanguage($tintuc->TieuDeKhongDau, Str::slug($request->TieuDe_en), Str::slug($request->TieuDe_vn), $tintuc);
                $this->updateLanguageApi($tintuc->TieuDeKhongDau, Str::slug($request->TieuDe_en), Str::slug($request->TieuDe_vn));
            }


            $this->updateLanguageApi($tintuc->TieuDe, $request->TieuDe_en, $request->TieuDe_vn);
           
            $this->updateLanguageApi($tintuc->NoiDung, $request->NoiDung_en, $request->NoiDung_vn);

            return redirect('/admin/blogs/tintuc')->with('success', 'Update successfully');
       
    }
    public function delete($id)
    {
       
            $tintuc = tintuc::with('languages')->findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($tintuc->image, $extension);
            foreach ($tintuc->languages as $language) {
                $this->deleteLanguage($language->key, 'en.json');
                $this->deleteLanguage($language->key, 'vn.json');

                $this->deleteLanguageApi($language->key, 'en.json');
                $this->deleteLanguageApi($language->key, 'vn.json');
            }
            $tintuc->languages()->delete();
            $tintuc->delete();
            return back()->with('success', 'Delete sucussefully');
      
    }
}
