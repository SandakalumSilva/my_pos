<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\CustomerInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function allCustomer()
    {
        return $this->customerRepository->allCustomer();
    }


    public function addCustomer()
    {
        return $this->customerRepository->addCustomer();
    }

    public function storeCustomer(Request $request)
    {
        return $this->customerRepository->storeCustomer($request);
    }

    public function editCustomer($id)
    {
        return $this->customerRepository->editCustomer($id);
    }

    public function updateCustomer(Request $request)
    {
        return $this->customerRepository->updateCustomer($request);
    }

    public function deleteCustomer($id)
    {
        return $this->customerRepository->deleteCustomer($id);
    }
}
