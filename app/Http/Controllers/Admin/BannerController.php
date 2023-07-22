<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function banner()
    {
        $title = 'Banner';
        $banners = Banner::get()->toArray();
        return view('admin.banner.banner')->with(compact('title', 'banners'));
    }
    public function bannerUpdateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }
    public function addEditBanner(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add new Banner";
            $banner = new Banner();
            $massage = "Banner Add Successfully";
        } else {
            $title = 'Edit Banner ';
            $banner = Banner::find($id);
            $massage = 'Edit Banner Successfulley';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasFile('images_banner')) {
                $image_tmp = $request->file('images_banner');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 9999) . '.' . $extension;
                    $imagePath = 'front/images/banner_image/' . $imageName;
                    Image::make($image_tmp)->save($imagePath);
                }
            }
            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->status = 1;
            $banner->save();
            return redirect('admin/banner')->with('massage', $massage);
        }
        return view('admin.banner.add-edit-banner')->with(compact('title', 'massage', 'banner'));
    }
    public function deleteBanner($id)
    {
        Banner::where('id',$id)->delete();
        return redirect()->back();
    }
}
