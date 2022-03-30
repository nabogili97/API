<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function upload(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $fileUpload = new Product;

        if ($request->file()) {
            $file = $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('product/img', $file, 'public');
            $fileUpload->category_id = $request->category_id;
            $fileUpload->name = $request->name;
            $fileUpload->brand_id = $request->brand_id;
            $fileUpload->price = $request->price;
            $fileUpload->discount = $request->discount;
            $fileUpload->retail_price = $request->retail_price;
            $fileUpload->description = $request->description;
            $fileUpload->content = $request->content;
            $fileUpload->status = $request->status;

            $target_dir    = "product/images/";
            $target_file   = $target_dir . basename($_FILES["file"]["name"]);

            $fileUpload->image = $target_file;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["file"]["name"]) .
                " Đã upload thành công.";

                echo "File lưu tại " .
                $target_file;
            }

            $fileUpload->save();

            return response()->json(['success' => 'File uploaded successfully.']);
        }
    }

    public function upadte(Request $request, $id)
    {

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $product = Product::find($id);

        if ($request->file()) {
            $file = $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('product/img', $file, 'public');
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            $product->retail_price = $request->retail_price;
            $product->description = $request->description;
            $product->content = $request->content;
            $product->qty = $request->qty;
            $product->status = $request->status;

            $target_dir    = "product/images/";
            $target_file   = $target_dir . basename($_FILES["file"]["name"]);

            $product->image = $target_file;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["file"]["name"]) .
                " Đã upload thành công.";

                echo "File lưu tại " .
                $target_file;
            }

            $product->save();

            return response()->json(['success' => 'File uploaded successfully.']);
        }
    }
}
