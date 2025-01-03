<?php

namespace App\Providers;

use App\Interfaces\AdminInterface;
use App\Interfaces\Backend\AttendenceInterface;
use App\Interfaces\Backend\CategoryInterface;
use App\Interfaces\Backend\CustomerInterface;
use App\Interfaces\Backend\EmployeeInterface;
use App\Interfaces\Backend\ExpenseInterface;
use App\Interfaces\Backend\PosInterface;
use App\Interfaces\Backend\ProductInterface;
use App\Interfaces\Backend\SalaryInterface;
use App\Interfaces\Backend\SupplierInterface;
use App\Repositories\AdminRepository;
use App\Repositories\Backend\AttendenceRepository;
use App\Repositories\Backend\CategoryRepository;
use App\Repositories\Backend\CustomerRepository;
use App\Repositories\Backend\EmployeeRepository;
use App\Repositories\Backend\ExpenseRepository;
use App\Repositories\Backend\PosRepository;
use App\Repositories\Backend\ProductRepository;
use App\Repositories\Backend\SalaryRepository;
use App\Repositories\Backend\SupplierRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
        $this->app->bind(SupplierInterface::class, SupplierRepository::class);
        $this->app->bind(SalaryInterface::class, SalaryRepository::class);
        $this->app->bind(AttendenceInterface::class, AttendenceRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(ExpenseInterface::class, ExpenseRepository::class);
        $this->app->bind(PosInterface::class,PosRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
