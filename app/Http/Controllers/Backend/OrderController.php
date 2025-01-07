<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function finalInvoice(Request $request)
    {
        return $this->orderRepository->finalInvoice($request);
    }
    public function pendingOrder()
    {
        return $this->orderRepository->pendingOrder();
    }

    public function orderDetails($id)
    {
        return $this->orderRepository->orderDetails($id);
    }

    public function orderStatusUpdate(Request $request)
    {
        return $this->orderRepository->orderStatusUpdate($request);
    }

    public function completeOrder()
    {
        return $this->orderRepository->completeOrder();
    }

    public function stockManage()
    {
        return $this->orderRepository->stockManage();
    }

    public function orderInvoice($id)
    {
        return $this->orderRepository->orderInvoice($id);
    }

    public function pendingDue()
    {
        return $this->orderRepository->pendingDue();
    }

    public function orderDueAjax($id)
    {
        return $this->orderRepository->orderDueAjax($id);
    }

    public function updateDue(Request $request)
    {
        return $this->orderRepository->updateDue($request);
    }
}
