<?php 
namespace App\Interfaces\Backend;

interface OrderInterface{
    public function finalInvoice($request);
    public function pendingOrder();
    public function orderDetails($id);
    public function orderStatusUpdate($request);
    public function completeOrder();
    public function stockManage();
    public function orderInvoice($id);
}