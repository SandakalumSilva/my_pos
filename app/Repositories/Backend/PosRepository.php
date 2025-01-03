<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\PosInterface;
use App\Models\Customer;
use App\Models\Product;

class PosRepository implements PosInterface
{

    public function pos()
    {
        $product = Product::latest()->get();
        $customer = Customer::latest()->get();
        return view('backend.pos.pos_page', compact('product', 'customer'));
    }
}
