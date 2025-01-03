<?php

namespace App\Interfaces\Backend;

interface ProductInterface
{

    public function allProduct();
    public function addProduct();
    public function storeProduct($request);
    public function editProduct($id);
    public function updateProduct($request);
    public function deleteProduct($id);
    public function barcodeProduct($id);
    public function importProduct();
    public function export();
    public function import($request);
}
