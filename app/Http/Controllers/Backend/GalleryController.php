<?php

namespace App\Http\Controllers\Backend;

use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Attribute;

class GalleryController extends Controller
{
    protected $gallery;
    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }
    public function addGallery($product_id)
    {
        $pro_id = $product_id;
        $template = 'backend.gallery.add';
        return view('backend.dashboard.layout', compact(
            'pro_id',
            'template'
        ));
    }

    public function insertGallery(Request $request, $pro_id)
    {
        $get_image = $request->file('fileImage');
        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                $image->move('uploads/gallery', $new_image);
                $gallery = new Gallery;
                $gallery->name = $new_image;
                $gallery->image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }
        }
        Session::put('message', 'Thêm thư viện ảnh thành công');
        return redirect()->back();
    }

    public function updateGalleryImage(Request $request)
    {
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/gallery', $new_image);

            $gallery = $this->gallery::find($gal_id);
            // Xoá ảnh cũ
            unlink('uploads/gallery/' . $gallery->image);
            // Thêm ảnh mới
            $gallery->image = $new_image;
            // Lưu
            $gallery->save();
        }
    }

    public function updateGalleryName(Request $request)
    {
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = $this->gallery::find($gal_id);
        $gallery->name = $gal_text;
        $gallery->save();
    }

    public function deleteGallery(Request $request)
    {
        $gal_id = $request->gal_id;
        $gallery = $this->gallery::find($gal_id);
        unlink('uploads/gallery/' . $gallery->image);
        $gallery->delete();
        return response()->json([], Response::HTTP_OK);
    }

    public function selectGallery(Request $request)
    {
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '
         <form>
                ' . csrf_field() . '
        <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>
                    Thứ tự
                </th>
                <th>
                    Hình ảnh
                </th>
                <th>
                    Tên ảnh
                </th>
                <th>
                    Đường dẫn ảnh
                </th>
                <th>
                    Thao tác
                </th>
            </tr>
        </thead>
        <tbody>
        ';

        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $key => $gal) {
                $i++;
                $output .= '
               
                <tr>
                    <td>' . $i . '</td>
                    <td>
                    <img width="120px" height="130px" src="' . asset('uploads/gallery/' . $gal->image) . '">
                    <input width="40%" 
                    data-gal_id="' . $gal->id . '" 
                    type="file" 
                    class="file_image" 
                    name="file" 
                    id="file-' . $gal->id . '" 
                    accept="image/*" />

                    </td>
                    <td contenteditable class="edit_gal_name" data-gal_id="' . $gal->id . '" >' . $gal->name . '</td>
                    <td>
                        ' . asset('uploads/gallery/' . $gal->image) . '
                    </td>
                    <td>
                        <button type="button" data-gal_id="' . $gal->id . '"  class="btn btn-white delete-gallery "><i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr> 
                ';
            };
        } else {
            $output .= '
             <tr>
                <td colspan="4">
                    Sản phẩm chưa có thư viện ảnh
                </td>
            </tr> 
            ';
        }

        $output .= '
                </tbody>
              </table>
            </form>

        ';

        echo $output;
    }
}
