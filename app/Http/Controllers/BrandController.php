<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Type\Hexadecimal;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate("5");
        return view('brands.brands', compact('brands'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate(['brand_name' => 'required|unique:brands|max:255', 'brand_image' => 'required|mimes:jpg,jpeg,png'], ['brand_name.required' => 'Brand name is required.', 'brand_name.max' => 'Brand name must be less than 255 characters.', 'brand_image.mimes' => 'accepted file extension: .jpg, .jepg, .png']);

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen . '.' . $img_ext;
        $up_loc = 'image/brand/';
        $final_filename = $up_loc . $image_name;

        $brand_image->move($up_loc, $image_name);
        Brand::insert(['brand_name' => $request->brand_name, 'brand_image' => $final_filename, 'user_id' => Auth::user()->id, 'created_at' => Carbon::now()]);

        return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    }
}
