<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public function index() {
        return view('backend.master');
    }

    public function AddPost() {
        return view('backend.add-post');
    }

    public function ListPost() {
        return view('backend.list-post');
    }

    // @List Log Activity
    public function ListLogActivity() {
        $Activity = DB::table('log_activity')
                        ->join('users', 'users.id', 'log_activity.author')
                        ->select('users.name', 'log_activity.*')
                        ->orderBy('log_activity.id', 'DESC')
                        ->get();
        
        return view('backend.log-activity', ['Activity' => $Activity]);

    }

    // @Website Logo
    public function AddLogo() {
        return view('backend.add-logo');
    }

    public function AddLogoSubmit(Request $request) {

        $file = $request->file('thumbnail');
        $logo = $this->uploadFile($file);
        $authorId = Auth::user()->id;

        $Logo = DB::table('logo')->insert([
            'thumbnail' => $logo,
            'created_at' => date('Y-m-d h:m:s'),
            'updated_at' => date('Y-m-d h:m:s')
        ]);

        if($Logo) {
            $this->logActivity('logo', 'logo', $authorId, 'Insert');
            return redirect('/admin/add-logo')->with('message', 'Add Logo Successfully');
        }
        else {
            return redirect('/admin/add-logo')->with('message', 'Oppp! Something went wrong');
        }

    }

    public function ListLogo() {

        $logo = DB::table('logo')
                ->orderBy('id', 'DESC')
                ->get();

        return view('backend.list-logo',[
            'logo' => $logo
        ]);
    }

    public function UpdateLogo($id) {
        $logo = DB::table('logo')
                    ->where('id', $id)
                    ->get();
        return view('backend.update-logo', [
            'logo' => $logo
        ]);
    }

    public function UpdateLogoSubmit(Request $request) {
        $id        = $request->id;
        $file      = $request->file('thumbnail');
        $thumbnail = $this->uploadFile($file);

        $logo  = DB::table('logo')
                    ->where('id', $id)
                    ->update([
                        'thumbnail' => $thumbnail
                    ]);
        if($logo) {
            $this->logActivity('logo', 'logo', Auth::user()->id, 'Update');
            return redirect('admin/list-logo');
        }

    }

    public function DeleteLogoSubmit(Request $request) {
        $logo = DB::table('logo')
                    ->where('id', $request->remove_id)
                    ->delete();
        if($logo) {
            return redirect('admin/list-logo');
        }

    }

    //News Blog
    public function AddNews() {
        return view('backend.add-news');
    }
    
    public function AddNewsSubmit(Request $request) {

        $slug      = $this->generateSlug($request->title);
        $file      = $request->file('thumbnail');
        $thumbnail = $this->uploadFile($file);
        $author    = Auth::user()->id;

        $news = DB::table('news')->insert([
            'title'         => $request->title,
            'slug'          => $slug,
            'thumbnail'     => $thumbnail,
            'author'        => $author,
            'viewer'        => 0,
            'description'   => $request->description,
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);

        if($news) {
            $this->logActivity($request->title, 'News', $author, 'Insert');
            return redirect('admin/add-news')->with('message' , 'News create successfully');
        }

    }

}
