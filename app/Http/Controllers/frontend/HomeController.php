<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function Home() {

        $newProducts = DB::table('product')
                            ->orderBy('id', 'DESC')
                            ->limit(4)
                            ->get();

        $promoProducts = DB::table('product')
                            ->where('sale_price', '<>', 0)
                            ->orderBy('id', 'DESC')
                            ->limit(4)
                            ->get();

        $popularProducts = DB::table('product')
                        ->orderBy('viewer', 'DESC')
                        ->limit(4)
                        ->get();

        return view('frontend.home', [
            'newProducts'     => $newProducts,
            'promoProducts'   => $promoProducts,
            'popularProducts' => $popularProducts,
        ]);

    }

    public function Shop(Request $request) {

        //Check Offset for pagination
        $postPerPage = 6;
        $offset = 0;
        if(!empty($request->page)) {
            $offset = ( $request->page - 1 ) * $postPerPage;
        }

        //Product
        $Product = DB::table('product');

        //Filter Price
        if(!empty($request->price)) {
            $priceObj = $request->price;
            if($priceObj == 'max') {
                $Product->orderBy('regular_price', 'DESC');
            }else {
                $Product->orderBy('regular_price', 'ASC');
            }
        }else {
            $Product->orderBy('id', 'DESC');
        }

        //Filter by Category
        if(!empty($request->category)) {
            $cateSlug = $request->category;
            $cateObj   = DB::table('category')
                            ->where('slug', $cateSlug)
                            ->select('id')
                            ->get();
            $cateId = $cateObj[0]->id;
            $Product->where('category_id', $cateId);
        }

        //Filter promotion products
        if(!empty($request->promotion)) {
            $Product->where('sale_price', '>', 0);
        }
                   
        $Product->offset($offset);
        $Product->limit($postPerPage);
        $getProduct = $Product->get();
        
        //Category
        $Category = DB::table('category')
                        ->orderBy('id', 'DESC')
                        ->get();

        //Pagination
        $allPro = DB::table('product')->count('id');
        $page   = ceil( $allPro / $postPerPage );

        return view('frontend.shop',[
            'products' => $getProduct,
            'category' => $Category,
            'page'     => $page
        ]);
    }

    public function Product($slug) {

        $ProductDetail = DB::table('product')
                            ->where('slug', $slug)
                            ->get();
        
        // Update Viewer
        $viewer = $ProductDetail[0]->viewer + 1;
        DB::table('product')
                ->where('slug', $slug)
                ->update([
                    'viewer' => $viewer
                ]);
        
        // Get Related Product
        $relatedPro = DB::table('product')
                        ->where('slug', '<>', $slug)
                        ->where('category_id', $ProductDetail[0]->category_id)
                        ->get();


        return view('frontend.product',[
            'ProductDetail' => $ProductDetail,
            'relatedPro'    => $relatedPro
        ]);
    }

    public function News() {

        $news = DB::table('news')
                    ->orderBy('id', 'DESC')
                    ->get();
        return view('frontend.news',[
            'news' => $news
        ]);
    }

    public function Article($slug) {

        $news = DB::table('news')
                    ->where('slug', $slug)
                    ->get();
        
        $viewer = $news[0]->viewer + 1;
        $newsId = $news[0]->id;
        
        DB::table('news')->where('id', $newsId)
                        ->update(['viewer'=> $viewer]);
                    
        return view('frontend.news-detail',[
            'news' => $news 
        ]);

    }

    public function Search(Request $request) {

        $Product = DB::table('product')
                    ->where('name', 'LIKE', '%'.$request->s.'%')
                    ->orderBy('id', 'DESC')
                    ->get();

        return view('frontend.search', [
            'Product' => $Product
        ]);
    }

}
