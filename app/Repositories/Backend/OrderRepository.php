<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\OrderInterface;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderInterface
{

    public function finalInvoice($request)
    {
        $validate = $request->validate(['pay' => 'required']);
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->sub_total;
        $data['invoice_no'] = 'mypos' . mt_rand(10000, 99999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->total - $request->pay;
        $data['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();

        $pdata = array();
        foreach ($contents as $content) {
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $content->id;
            $pdata['quantity'] = $content->qty;
            $pdata['unitcost'] = $content->price;
            $pdata['total'] = $content->total;

            $insert = Orderdetails::insert($pdata);
            Product::where('id', $content->id)
                ->update(['product_store' => DB::raw('product_store-' . $content->qty)]);
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Order Completed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function pendingOrder()
    {
        $orders = Order::where('order_status', 'pending')->get();
        return view('backend.order.pending_order', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::where('id', $id)->first();

        $orderItem = Orderdetails::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        return view('backend.order.order_details', compact('order', 'orderItem'));
    }

    public function orderStatusUpdate($request)
    {
        $orderId = $request->id;

        //$product = Orderdetails::where('order_id', $orderId)->get();
        // foreach ($product as $item) {
        //     Product::where('id', $item->product_id)
        //         ->update(['product_store' => DB::raw('product_store-' . $item->quantity)]);
        // }

        Order::findOrFail($orderId)->update(['order_status' => 'complete']);

        $notification = array(
            'message' => 'Order Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.order')->with($notification);
    }

    public function completeOrder()
    {
        $orders = Order::where('order_status', 'complete')->get();
        return view('backend.order.complete_order', compact('orders'));
    }

    public function stockManage()
    {
        $product = Product::latest()->get();
        return view('backend.stock.all_stock', compact('product'));
    }

    public function orderInvoice($id)
    {
        $order = Order::where('id', $id)->first();

        $orderItem = Orderdetails::with('product')->where('order_id', $id)->orderBy('id', 'desc')->get();

        $pdf = Pdf::loadView('backend.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download($order->invoice_no . '.pdf');
    }

    public function pendingDue()
    {
        $alldue = Order::where('due', '>', '0')->orderBy('id', 'DESC')->get();
        return view('backend.order.pending_due', compact('alldue'));
    }

    public function orderDueAjax($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    public function updateDue($request)
    {
        $order_id = $request->id;
        $due_amount = $request->due;
        $pay_amount = $request->pay;

        $allOrder = Order::findOrFail($order_id);
        $mainDue = $allOrder->due;
        $mainpay = $allOrder->pay;

        $paid_due = $mainDue - $due_amount;
        $paid_pay = $mainpay + $due_amount;
        // dd($allOrder);
        Order::findOrFail($order_id)->update([
            'due' => $paid_due,
            'pay' => $paid_pay,
        ]);

        $notification = array(
            'message' => 'Due Amount Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.due')->with($notification);
    }
}
