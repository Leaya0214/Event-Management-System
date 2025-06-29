<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\BackEnd\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class BlogController extends Controller
{
    public function index()
    {
        if (!check_access("blog.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $blogs = Blog::all();
        return view('BackEnd.webcontent.blog.blog', compact('blogs'));
    }

    public function getAll()
    {
        $blogs = Blog::orderby('id', 'desc')->get();

        return DataTables::of($blogs)
            ->addIndexColumn()
            ->setRowId(function ($blog) {
                return $blog->id; })
            ->setRowAttr([
                'align' => 'center',
            ])
            ->addColumn('title', function ($blog) {
                $title = $blog->title;
                return $title;
            })
            ->addColumn('image', function ($blog) {
                $url = asset("backend/blog/" . $blog->image);
                $image = '<img src="' . $url . '" style="width:100px;height: 70px;"  id="myImg">';
                return $image;
            })
            ->addColumn('status', function ($blog) {
                if ($blog->status == 1) {
                    $status =
                        '<span
                            style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                            class="btn btn-xs btn-sm mr-1">Active</span>';
                } else {
                    $status =
                        '<span style="color:white; border-radius:5px; background-color:rgb(177, 28, 2); "
                            class="btn btn-xs  btn-sm mr-1">Inactive</span>';
                }

                return $status;

            })

            ->addColumn('action', function ($blog) {

                $status ='';
                $view  = '';
                $edit  = '';
                $delete  = '';
                if (check_access("blog.edit")) {
                    if ($blog->status == 1) {
                        $status =
                            "<a href='" . route("blog.status", $blog->id) . "' style='padding:2px;'
                            class='btn btn-xs btn-success btn-sm mr-1'>
                            <svg  width='16' height='14' viewBox='0 0 24 24'
                                fill='none' stroke='currentColor' stroke-width='2'
                                stroke-linecap='round' stroke-linejoin='round'
                                class='feather feather-arrow-up'>
                                <line x1='12' y1='19' x2='12' y2='5'>
                                </line>
                                <polyline points='5 12 12 5 19 12'></polyline>
                            </svg></a>
                            ";
                    } else {
                        $status =
                            "<a href='" . route("blog.status", $blog->id) . "'
                                style='padding:2px;background-color:rgb(202, 63, 82); color:white'
                                class='btn btn-xs btn-sm mr-1'><svg width='16' height='14'
                                    viewBox='0 0 26 26' fill='none' stroke='currentColor'
                                    stroke-width='2' stroke-linecap='round' stroke-linejoin='round'
                                    class='feather feather-arrow-down'>
                                    <line x1='12' y1='5' x2='12' y2='19'>
                                    </line>
                                    <polyline points='19 12 12 19 5 12'></polyline>
                                </svg></a>
                        ";

                    }

                }
                if (check_access("blog.list")) {

                    $view = ' <a href=""  data-bs-toggle="modal" 
                        data-bs-target=".image_modal-' . $blog->id . '" style="padding:2px; margin-left:3px; color:white"
                        class="btn btn-xs btn-info btn-sm mr-1">
                        <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </a>';
                }
                if (check_access("blog.edit")) {

                    $edit = '<a href="' . route('blog.edit', $blog->id) . '" style="padding:2px; margin-left:3px"
                        class="btn btn-xs btn-primary btn-sm mr-1">
                        <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>';
                }
                if (check_access("blog.delete")) {
                    $delete = '<a href="' . route('blog.delete', $blog->id) . '"
                onclick="return confirm("Are you sure you want to delete?");"
                style="padding: 2px; margin-left:3px;" class="delete btn btn-xs btn-danger btn-sm mr-1"><svg
                width="16" height="14" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-trash-2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                </path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg></a>';
                }

                return $status . $view . $edit . $delete;
            })


            ->rawColumns(['name', 'image', 'status', 'action'])
            ->make(true);
    }

    public function addBlog()
    {
        if (!check_access("blog.add")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.blog.addblog');
    }

    public function storeBlog(Request $request)
    {
        if (!check_access("blog.add")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validators = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validators->fails()) {
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_enc_name = rand(0, 9999) . time() . md5($file->getClientOriginalName());
            $image_extension = $file->getClientOriginalExtension();
            $image_name = $image_enc_name . "." . $image_extension;

            $destination_path = "backend/blog/";
            $file->move($destination_path, $image_name);
        } else {
            $image_name = "";
        }

        $data = [
            'title' => $request->title,
            'image' => $image_name,
            'description' => $request->description,
            'status' => 1
        ];

        $blog = Blog::create($data);

        if ($files = $request->file('gallery')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('backend/blog_gallery/', time() . '-' . $name);
                $gallery = time() . '-' . $name;

                DB::table('blog_images')->insert([
                    'blog_id' => $blog->id,
                    'image' => $gallery
                ]);

            }
        }

        Toastr::success("Data Inserted Successfully!");
        return redirect()->route('blog');

    }

    public function edit($id)
    {
        if (!check_access("blog.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $blog = Blog::where('id', $id)->first();
        $images = DB::table('blog_images')->where('blog_id', $blog->id)->get();

        return view('BackEnd.webcontent.blog.editblog', compact('blog', 'images'));
    }
    public function update(Request $request, $id)
    {
        if (!check_access("blog.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $blog = Blog::where('id', $id)->first();
        $image_name = $blog->image;
        $validators = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validators->fails()) {
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        if ($request->hasFile('image')) {
            $path = public_path() . "backend/blog/" . $blog->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('image');
            $image_enc_name = rand(0, 9999) . time() . md5($file->getClientOriginalName());
            $image_extension = $file->getClientOriginalExtension();
            $image_name = $image_enc_name . "." . $image_extension;
            $destination_path = "backend/blog/";
            $file->move($destination_path, $image_name);
        }
        $data = [
            'title' => $request->title,
            'image' => $image_name,
            'description' => $request->description,
            'status' => 1
        ];

        $blog->update($data);

        if ($files = $request->file('gallery')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('backend/blog_gallery/', time() . '-' . $name);
                $gallery = time() . '-' . $name;
                DB::table('blog_images')->insert([
                    'blog_id' => $id,
                    'image' => $gallery
                ]);
            }
        }

        Toastr::success("Data Updated Successfully!");
        return redirect()->route('blog');
    }
    public function statusUpdate($id)
    {
        try {
            if (!check_access("blog.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Blog::find($id);
            if ($status->status == 1) {
                $status->status = 0;
                Toastr::warning("Status Inactive !");
            } else {
                $status->status = 1;
                Toastr::success("Status Activated !");
            }
            $status->save();

            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    public function destroy($id)
    {
        try {
            if (!check_access("blog.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }

            $data = Blog::find($id);
            $data->delete();
            Toastr::success("Deleted Successfully !!");
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function deleteImage($id)
    {
        try {
            if (!check_access("blog.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $data = DB::table('blog_images')->delete($id);
            Toastr::success("Deleted Successfully !!");
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
