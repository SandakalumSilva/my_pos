<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\SupplierInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierRepository;

    public function __construct(SupplierInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function allSupplier()
    {
        return $this->supplierRepository->allSupplier();
    }


    public function addSupplier()
    {
        return $this->supplierRepository->addSupplier();
    }

    public function storeSupplier(Request $request)
    {
        return $this->supplierRepository->storeSupplier($request);
    }

    public function detailsSupplier($id){
        return $this->supplierRepository->detailsSupplier($id);
    }

    public function editSupplier($id)
    {
        return $this->supplierRepository->editSupplier($id);
    }

    public function updateSupplier(Request $request)
    {
        return $this->supplierRepository->updateSupplier($request);
    }

    public function deleteSupplier($id)
    {
        return $this->supplierRepository->deleteSupplier($id);
    }
}
