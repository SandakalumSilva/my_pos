<?php

namespace App\Repositories\Backend;

use App\Imports\ProductImport;
use App\Interfaces\Backend\ProductInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductRepository implements ProductInterface
{

    public function allProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.all_product', compact('products'));
    }

    public function addProduct()
    {
        $category = Category::all();
        $supplier = Supplier::all();
        return view('backend.product.add_product', compact('category', 'supplier'));
    }

    public function storeProduct($request)
    {

        $validate = $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'product_garage' => 'required',
            'product_store' => 'required',
            'buying_date' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required'
        ]);

        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 4, 'prefix' => 'PC']);

        $manager = new ImageManager(new Driver());

        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $file = $manager->read($image);
            $file->resize(300, 300)->save('upload/product/' . $nameGen);

            $saveUrl = 'upload/product/' . $nameGen;
        } else {
            $saveUrl = '';
        }

        Product::insert([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $pcode,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.edit_product', compact('product', 'category', 'supplier'));
    }

    public function updateProduct($request)
    {
        $validate = $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'product_garage' => 'required',
            'product_store' => 'required',
            'buying_date' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required'
        ]);

        $productId = $request->id;

        $manager = new ImageManager(new Driver());

        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $file = $manager->read($image);
            $file->resize(300, 300)->save('upload/product/' . $nameGen);

            $saveUrl = 'upload/product/' . $nameGen;

            Product::findOrFail($productId)->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'product_image' => $saveUrl,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Product::findOrFail($productId)->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function deleteProduct($id)
    {
        $product_img = Product::findOrFail($id);
        $img = $product_img->product_image;
        unlink($img);

        Product::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product Deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function barcodeProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.barcode_product', compact('product'));
    }

    public function importProduct()
    {
        return view('backend.product.import_product');
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function import($request)
    {
        $validate = $request->validate(['import_file' => 'required']);
        Excel::import(new ProductImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Product Imported successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
