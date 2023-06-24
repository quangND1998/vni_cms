<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FunctionTrait;
use App\Models\theloai;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TheLoaiController extends Controller
{
    public function index()
    {
      
            $theloais = theloai::get();

            return Inertia::render('Blog/TheLoai', compact('theloais'));
       
    }

    public function store(Request $request)
    {

        
            $this->validate(
                $request,
                [
                    'Ten' => 'required|unique:theloais,Ten|min:3|max:100'

                ],
                [
                    'Ten.required' => 'Bạn chưa nhập tên Thể Loại!',
                    'Ten.unique' => 'Tên Thể Loại đã tồn tại, vui lòng nhập lại!',
                    'Ten.min' => 'Tên Thể Loại gồm ít nhất 3 ký tự!',
                    'Ten.max' => 'Tên Thể Loại gồm tối đa 100 ký tự!'
                ]
            );

            // Thêm dữ liệu vào CSDL, ở đây 1 record dữ liệu được xem như một đối tượng (object), vì ta sử dụng Eloquent nên tất cả các bảng trong CSDL đã được ánh xạ thành Model trong Laravel. Do đó dữ liệu mới được thêm vào bằng cách tạo 1 đối tượng mới.

            $theloai = new theloai();
            $theloai->Ten = $request->Ten;
            $theloai->TenKhongDau = Str::slug($request->Ten);
            $theloai->save();
            return back()->with('success', 'Create successfully');
      
    }

    public function update(Request $request, $id)
    {
        

            $theloai = TheLoai::findOrFail($id);
            $this->validate(
                $request,
                [
                    'Ten' => 'required|min:3|max:100|unique:theloais,Ten,' . $theloai->id
                ],
                [
                    'Ten.required' => 'Bạn chưa nhập tên Thể Loại!',
                    'Ten.unique' => 'Tên Thể Loại đã tồn tại, vui lòng nhập lại!!',
                    'Ten.min' => 'Tên Thể Loại gồm ít nhất 3 ký tự!',
                    'Ten.max' => 'Tên Thể Loại gồm tối đa 100 ký tự!'
                ]
            );

            $theloai->Ten = $request->Ten;
            $theloai->TenKhongDau = Str::slug($request->Ten);
            $theloai->save();
            return back()->with('success', 'Create successfully');
            $theloai->save();
       
    }

    public function delete($id)
    {
        
            $theloai = theloai::findOrFail($id);

            $theloai->delete();
            return back()->with('success', 'Delete successfully');
      
    }
}
