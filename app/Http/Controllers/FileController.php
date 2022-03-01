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
            $file = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('product', $file, 'public');
            $fileUpload->category_id = $request->category_id;
            $fileUpload->name = $request->name;
            $fileUpload->brand_id = $request->brand_id;
            $fileUpload->price = $request->price;
            $fileUpload->retail_price = $request->retail_price;
            $fileUpload->description = $request->description;
            $fileUpload->content = $request->content;
            $fileUpload->status = $request->status;

            $fileUpload->image = '/storage/' . $file_path;

            // // $files  = Storage::putFile('file', $request->file('file'));
            // Storage::putFile('file', new File('/product/img'), 'public');

            $fileUpload->save();

            return response()->json(['success' => 'File uploaded successfully.']);
        }
    }
}
