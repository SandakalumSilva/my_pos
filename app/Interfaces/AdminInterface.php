<?php

namespace App\Interfaces;

interface AdminInterface
{
    public function adminDestroy($request);
    public function adminLogoutPage();
    public function adminProfile();
    public function adminProfileStore($request);
    public function changePassword();
    public function updatePassword($request);
    public function allAdmin();
    public function addAdmin();
    public function storeAdmin($request);
    public function editAdmin($id);
    public function updateUser($request);
    public function deleteUser($id);
}
