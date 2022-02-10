<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Requests\StoreProductCategoryRequest;

use App\Models\ProductCategory;

use DataTables;
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = ProductCategory::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<form action="'.route('product_categories.destroy', $row->id).'" method="post">';
                    $btn .= csrf_field();
                    $btn .= '<input name="_method" type="hidden" value="DELETE">';
                    $btn .= '<a href="'.url('/product_categories'.'/'.$row->id.'/edit').'" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= "<button class=\"btn btn-sm btn-danger\" type=\"submit\" onclick=\"return confirm('Yakin untuk menghapus?')\">Delete</button>";
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        };
        
        return view('backoffice.product_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state = 'create';
        $url = url("/product_categories");
        return view('backoffice.product_categories.form',compact('state','url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $product_categories = new ProductCategory;
        $product_categories->name = $request->name;
        $product_categories->user_id = auth()->user()->id;
        $product_categories->save();
        return redirect('/product_categories')->with('success', 'Success Create Kategori Produk');  
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = 'edit';
        $url = url("/product_categories")."/".$id;
        $product_category = ProductCategory::find($id);
        if ($product_category == null)
            return redirect('/product_categories')->with('warning', 'Kategori Produk Tidak ditemukan');
        return view('backoffice.product_categories.form',compact('product_category','state','url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoryRequest $request, $id)
    {
        $product_categories = ProductCategory::find($id);
        $product_categories->name = $request->name;
        $product_categories->save();
        return redirect('/product_categories')->with('success', 'Success Update Kategori Produk');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_categories = ProductCategory::find($id);
        if ($product_categories == null)
            return redirect('/product_categories')->with('warning', 'Kategori Produk Tidak ditemukan');
        $product_categories->delete();
        return redirect('/product_categories')->with('success', 'Success Delete Kategori Produk');  
    }
}
