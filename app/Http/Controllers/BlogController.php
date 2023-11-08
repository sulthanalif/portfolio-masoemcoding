<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Helpers\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $blogs = Blog::with("user")->get();

        $data = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'user' => [
                    'id' => $blog->user_id,
                    'name' => $blog->user->name,
                ],
                'tittle' => $blog->title,
                'content' => $blog->content,
                'image' => $blog->image,
                'created_at' => $blog->created_at,
            ];
        });

        if ($data->isEmpty()){
            return Response::error('','Tidak Ada Data');
        }

        return Response::success($data, 'Data Berhasil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'tittle' => 'required',
            'user_id' => 'required',
            'content' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return Response::error('', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, &$blog) {
                $tittle = $request->input('tittle');
                $user_id = $request->input('user_id');
                $content = $request->input('content');
                $file = $request->file('image');
                 // mendapatkan original extensionnya
                 $imageData = $file->getClientOriginalExtension();
                 //membuat nama file dengan epochtime
                 $image = strtotime(date('Y-m-d H:i:s')) . '.' . $imageData;

                 $blog = Blog::create([
                    'tittle' => $tittle,
                    'user_id' => $user_id,
                    'content' => $content,
                    'image' => $image
                 ]);
                 // Simpan file dengan nama yang sudah dikodekan ke direktori public/upload
                $file->move(base_path('public/upload'), $image);
                });
                if ($blog) {
                   return Response::success($blog, 'Data Berhasil Disimpan');
                } else {
                   return Response::error('', 'Data Gagal Disimpan');
                }
        } catch (\Exception $e) {
            return Response::error('', 'Terjadi Kesalahan Sistem');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
