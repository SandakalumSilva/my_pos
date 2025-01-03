<?php

namespace App\Interfaces\Backend;

interface CategoryInterface
{

    public function allCategory();
    public function storeCategory($request);
    public function editCategory($id);
    public function updateCategory($request);
    public function deleteCategory($id);
}
