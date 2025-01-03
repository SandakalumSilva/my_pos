<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function allCategory()
    {
        return $this->categoryRepository->allCategory();
    }

    public function storeCategory(Request $request)
    {
        return $this->categoryRepository->storeCategory($request);
    }

    public function editCategory($id)
    {
        return $this->categoryRepository->editCategory($id);
    }

    public function updateCategory(Request $request)
    {
        return $this->categoryRepository->updateCategory($request);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}
