<?php

namespace App\Interfaces\Backend;

interface CustomerInterface
{
    public function allCustomer();
    public function addCustomer();
    public function storeCustomer($request);
    public function editCustomer($id);
    public function updateCustomer($request);
    public function deleteCustomer($id);
}
