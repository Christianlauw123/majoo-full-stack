<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use App\Models\Product;
use App\Models\ProductCategory;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Exception;
use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product_category_id', function($row){
                    return $row->product_category->name;
                })
                ->addColumn('price', function($row){
                    return 'Rp '.number_format($row->price, 2, '.', ',');
                })
                ->addColumn('action', function($row){
                    $btn = '<form action="'.route('products.destroy', $row->id).'" method="post">';
                    $btn .= csrf_field();
                    $btn .= '<input name="_method" type="hidden" value="DELETE">';
                    $btn .= '<a href="'.url('/products'.'/'.$row->id).'" class="btn btn-sm btn-success">Show</a>';
                    $btn .= '<a href="'.url('/products'.'/'.$row->id.'/edit').'" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= "<button class=\"btn btn-sm btn-danger\" type=\"submit\" onclick=\"return confirm('Yakin untuk menghapus?')\">Delete</button>";
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        };
        
        return view('backoffice.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state = 'create';
        $url = url("/products");
        $product_categories = ProductCategory::all();
        return view('backoffice.products.form',compact('product_categories','state','url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $path = "";
        DB::beginTransaction();
        try{
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price  = $request->price;

            if ($request->hasFile('image_path')){
                $extension = $request->file('image_path')->getClientOriginalExtension();
                $path = $request->file('image_path')->storeAs('public/product_image', time().'_'.$extension);
                $product->image_path  = 'product_image/'.time().'_'.$extension;
            }
            
            $product->product_category_id = $request->product_category_id;
            $product->user_id = auth()->user()->id;
            $product->save();

            DB::commit();
            if ($request->ajax()){
                session()->flash('success', 'Success Create Produk');
                return response()->json(["code"=>200,"url"=>url('/products')]);
            }
            return redirect('/products')->with('success', 'Success Create Produk');
        }catch(Exception $e){
            DB::rollBack();
            if ($path != "")
                Storage::delete($path);
            return back()->withErrors([
                "errors" => $e->getMessage()
            ])->withInput();
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
        $state = "show";
        $product = Product::find($id);
        if ($product == null)
            return redirect('/products')->with('warning', 'Produk Tidak ditemukan');
        
        return view('backoffice.products.form',compact('product','state'));
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
        $url = url("/products")."/".$id;
        $product = Product::find($id);
        if ($product == null)
            return redirect('/products')->with('warning', 'Produk Tidak ditemukan');
        $product_categories = ProductCategory::all();
        return view('backoffice.products.form',compact('product_categories','product','state','url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $path = "";
        DB::beginTransaction();
        try{
            $product = Product::find($id);
            if ($product == null)
                return redirect('/products')->with('warning', 'Produk Tidak ditemukan');

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price  = $request->price;
            
            //Rubah Filenya jika ada
            if ($request->hasFile('image_path')){
                $extension = $request->file('image_path')->getClientOriginalExtension();
                $path = $request->file('image_path')->storeAs('public/product_image', time().'_'.$extension);
                $product->image_path  = 'product_image/'.time().'_'.$extension;
            }

            $product->product_category_id = $request->product_category_id;
            $product->save();
            DB::commit();

            if ($request->ajax()){
                session()->flash('success', 'Success Update Produk');
                return response()->json(["code"=>200,"url"=>url('/products')]);
            }

            return redirect('/products')->with('success', 'Success Update Produk');
        }catch(Exception $e){
            DB::rollBack();
            if ($path != "")
                Storage::delete($path);
            return back()->withErrors([
                "errors" => $e->getMessage()
            ])->withInput();
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
        DB::beginTransaction();
        try{
            $product = Product::find($id);
            if ($product == null)
                return redirect('/products')->with('warning', 'Produk Tidak ditemukan');
            $image_path = $product->image_path;
            $product->delete();
            DB::commit();

            Storage::delete($image_path);

            return redirect('/products')->with('success', 'Success Delete Produk');
        }catch(Exception $e){
            DB::rollBack();
            return redirect('/products')->with('warning', $e->getMessage());
        }
    }
}
