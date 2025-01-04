<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\PosInterface;
use Illuminate\Http\Request;

class PosController extends Controller
{
    protected $posRepository;
    public function __construct(PosInterface $posRepository)
    {
        $this->posRepository = $posRepository;
    }

    public function pos()
    {
        return $this->posRepository->pos();
    }

    public function addCart(Request $request)
    {
        return $this->posRepository->addCart($request);
    }

    public function allItem()
    {
        return $this->posRepository->allItem();
    }

    public function cartUpdate(Request $request,$id){
        return $this->posRepository->cartUpdate($request,$id);
    }
    public function cartRemove($id){
        return $this->posRepository->cartRemove($id);
    }

    public function createInvoice(Request $request){
        return $this->posRepository->createInvoice($request);
    }
}
