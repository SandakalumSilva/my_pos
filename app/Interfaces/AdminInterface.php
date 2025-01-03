<?php

namespace App\Interfaces;

interface AdminInterface{
    public function adminDestroy($request);
    public function adminLogoutPage();
    public function adminProfile();
    public function adminProfileStore($request);
    public function changePassword();
    public function updatePassword($request);
}