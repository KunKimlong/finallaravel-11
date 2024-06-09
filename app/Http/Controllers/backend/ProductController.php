<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function ListProduct() {

        $Product = DB::table('product')
                    ->join('category', 'product.category_id', 'category.id')
                    ->join('users', 'product.author', 'users.id')
                    ->select('users.name AS authorName', 'category.name AS cateName', 'product.*')
                    ->orderBy('product.id', 'DESC')
                    ->get();

        return view('backend.list-product', [
            'Product' => $Product
        ]);
    }

    public function AddProduct() {

        $attrSize  = ['S', 'M', 'L', 'XL'];
        $attrColor = ['Red', 'Blue', 'Yellow', 'Navy', 'Black'];
        $category  = DB::table('category')->get();

        return view('backend.add-product', [
            'category'  => $category,
            'attrSize'  => $attrSize,
            'attrColor' => $attrColor,
        ]);

    }

    public function AddProductSubmit(Request $request) {

        $name           = $request->name;
        $slug           = $this->generateSlug($name);
        $qty            = $request->qty;
        $regularPrice   = $request->regular_price;
        $salePrice      = $request->sale_price;
        $category       = $request->category;
        $description    = $request->description;
        $viewer         = 0;
        $author         = Auth::user()->id;
        $createdAt      = date('Y-m-d H:m:s');
        $updatedAt      = date('Y-m-d H:m:s');

        //Product Thumbnail
        $file           = $request->file('thumbnail');
        $thumbnail      = $this->uploadFile($file);

        //Product Attribute 
        $attrSize  = $request->size;
        $size      = implode(', ', $attrSize);
        
        $attrColor = $request->color;
        $color     = implode(', ', $attrColor);

        $Product = DB::table('product')->insert([
            'name'              => $name,
            'quantity'          => $qty,
            'slug'              => $slug,
            'regular_price'     => $regularPrice,
            'sale_price'        => $salePrice != '' ? $salePrice : 0,
            'category_id'       => $category,
            'attribute_color'   => $color,
            'attribute_size'    => $size,
            'thumbnail'         => $thumbnail,
            'viewer'            => $viewer,
            'author'            => $author,
            'description'       => $description,
            'created_at'        => $createdAt,
            'updated_at'        => $updatedAt,
        ]);

        if($Product) {
            $this->logActivity($name, 'Product', $author, 'Insert');
            return redirect('/admin/add-product')->with('message', 'Product create successfully');
        }

    }

    public function UpdateProduct($id) {

        $attrSize  = ['S', 'M', 'L', 'XL'];
        $attrColor = ['Red', 'Blue', 'Yellow', 'Navy', 'Black'];
        $category  = DB::table('category')->get();
        $product   = DB::table('product')
                        ->where('id', $id)
                        ->get();
        $size = $product[0]->attribute_size;
        $color = $product[0]->attribute_color;

        return view('backend.update-product', [
            'product'   => $product,
            'category'  => $category,
            'attrSize'  => $attrSize,
            'attrColor' => $attrColor,
            'size'      => explode(', ',$size),
            'color'     => explode(', ',$color)
        ]);
    }

    public function UpdateProductSubmit(Request $request) {

        //Check Thumbnail
        if(!empty($request->thumbnail)) {
            $file      = $request->thumbnail;
            $thumbnail = $this->uploadFile($file);
        }
        else {
            $thumbnail = $request->oldThumbnail;
        }

        //Product Attribute 
        $attrSize  = $request->size;
        $size      = implode(', ', $attrSize);
        
        $attrColor = $request->color;
        $color     = implode(', ', $attrColor);

        $Product = DB::table('product')
                        ->where('id', $request->id)
                        ->update([
                            'name'              => $request->name,
                            'quantity'          => $request->qty,
                            'regular_price'     => $request->regular_price,
                            'sale_price'        => $request->sale_price != '' ? $request->sale_price : 0,
                            'category_id'       => $request->category,
                            'attribute_color'   => $color,
                            'attribute_size'    => $size,
                            'thumbnail'         => $thumbnail,
                            'description'       => $request->description,
                            'updated_at'        => date('Y-m-d H:m:s'),
                        ]);

        if($Product) {
            $this->logActivity($request->name, 'Product', Auth::user()->id, 'Update');
            return redirect('/admin/list-product')->with('message', 'Product update successfully');
        }
    }

}
