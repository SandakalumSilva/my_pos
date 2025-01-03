<?php

namespace App\Interfaces\Backend;

interface SupplierInterface
{
    public function allSupplier();
    public function addSupplier();
    public function storeSupplier($request);
    public function detailsSupplier($id);
    public function editSupplier($id);
    public function updateSupplier($request);
    public function deleteSupplier($id);
}
