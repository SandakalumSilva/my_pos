<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    protected $adminRepository;
    public function __construct(AdminInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function adminDestroy(Request $request)
    {
        return $this->adminRepository->adminDestroy($request);
    }

    public function adminLogoutPage()
    {
        return $this->adminRepository->adminLogoutPage();
    }

    public function adminProfile()
    {
        return $this->adminRepository->adminProfile();
    }

    public function adminProfileStore(Request $request)
    {
        return $this->adminRepository->adminProfileStore($request);
    }

    public function changePassword()
    {
        return $this->adminRepository->changePassword();
    }

    public function updatePassword(Request $request)
    {
        return $this->adminRepository->updatePassword($request);
    }
}
