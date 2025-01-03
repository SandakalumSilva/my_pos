<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\PosInterface;
use App\Models\Customer;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosRepository implements PosInterface
{

    public function pos()
    {
        $product = Product::latest()->get();
        $customer = Customer::latest()->get();
        return view('backend.pos.pos_page', compact('product', 'customer'));
    }

    public function addCart($request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 20,
            'option' => ['size' => 'large']
        ]);

        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function allItem()
    {
        $product_item = Cart::content();
        return view('backend.pos.text_item', compact('product_item'));
    }

    public function cartUpdate($request, $id)
    {
        $qty = $request->qty;
        $update = Cart::update($id, $qty);

        $notification = array(
            'message' => 'Cart Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function cartRemove($id)
    {
        Cart::remove($id);
        
        $notification = array(
            'message' => 'Cart Item Removed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
