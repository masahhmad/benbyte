<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use App\Models\CommentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = BlogModel::orderBy('created_at', 'desc')->get();
        
        return view('pages.home', [
            'blogs' => $blogs,
        ]);
    }

    public function blog($id)
    {
        $blog = BlogModel::findOrFail($id);

        return view('pages.blog', compact('blog'));
    }

    public function komentar()   
    {
        return view('pages.komen');
    }

    public function kirimKomentar(Request $request)
    {
        CommentModel::create([
            'name' => $request->nama_komen,
            'komen' => $request->komentar,
        ]);

        return redirect()->route(auth::user()->role . '.home')->with('msg', 'Berhasil mengirim komentar');
    }
}
