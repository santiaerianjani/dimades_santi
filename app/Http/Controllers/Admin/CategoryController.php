<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::orderBy('name', 'ASC')->paginate(10);
        $this->data['data'] = $data;
        return view('admin.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (Category::create($request->all())) {
                Session::flash('success', 'Category has been saved');
            } else {
                Session::flash('error', 'Category could not be saved');
            }
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Session::flash('error', "Periksa Kembali Isian");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $data;
        return view('admin.category.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Category::findOrFail(Crypt::decrypt($id));
            if ($data->update($request->all())) {
                Session::flash('success', 'Category has been updated');
            } else {
                Session::flash('error', 'Category could not be update');
            }
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Session::flash('error', "Periksa Kembali Isian");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::findOrFail(Crypt::decrypt($id));
        if ($data->delete()) {
            Session::flash('success', 'category has been deleted');
        } else {
            Session::flash('error', 'category could not be delete');
        }
        return redirect()->route('category.index');
    }
}
