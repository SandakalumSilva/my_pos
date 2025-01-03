<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function allProduct()
    {
        return $this->productRepository->allProduct();
    }

    public function addProduct()
    {
        return $this->productRepository->addProduct();
    }

    public function storeProduct(Request $request)
    {
        return $this->productRepository->storeProduct($request);
    }

    public function editProduct($id)
    {
        return $this->productRepository->editProduct($id);
    }

    public function updateProduct(Request $request)
    {
        return $this->productRepository->updateProduct($request);
    }
    public function deleteProduct($id){
        return $this->productRepository->deleteProduct($id);
    }

    public function barcodeProduct($id){
        return $this->productRepository->barcodeProduct($id);
    }
    public function importProduct(){
        return $this->productRepository->importProduct();
    }

    public function export(){
        return $this->productRepository->export();
    }
    public function import(Request $request){
        return $this->productRepository->import($request);
    }
}
