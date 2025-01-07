<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AttendenceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'adminDestroy')->name('admin.logout');
    Route::get('/admin/logout/page', 'adminLogoutPage')->name('admin.logout.page');

    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/profile', 'adminProfile')->name('admin.profile');
        Route::post('/admin/profile/store', 'adminProfileStore')->name('admin.profile.store');
        Route::get('/change/password', 'changePassword')->name('admin.change.password');
        Route::post('/update/password', 'updatePassword')->name('update.password');
    });
});

/// Employee Route
Route::controller(EmployeeController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/employee', 'allEmployee')->name('all.employee');
        Route::get('/add/employee', 'addEmployee')->name('add.employee');
        Route::post('/store/employee', 'storeEmployee')->name('employee.store');
        Route::get('/edit/employee/{id}', 'editEmployee')->name('edit.employee');
        Route::post('/update/employee', 'updateEmployee')->name('employee.update');
        Route::get('/delete/employee/{id}', 'deleteEmploye')->name('delete.employee');
    });
});

/// Customer Route
Route::controller(CustomerController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/customer', 'allCustomer')->name('all.customer');
        Route::get('/add/customer', 'addCustomer')->name('add.customer');
        Route::post('/store/customer', 'storeCustomer')->name('customer.store');
        Route::get('/edit/customer/{id}', 'editCustomer')->name('edit.customer');
        Route::post('/update/customer', 'updateCustomer')->name('customer.update');
        Route::get('/delete/customer/{id}', 'deleteCustomer')->name('delete.customer');
    });
});

/// Supplier Route
Route::controller(SupplierController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/supplier', 'allSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'addSupplier')->name('add.supplier');
        Route::post('/store/supplier', 'storeSupplier')->name('supplier.store');
        Route::get('/edit/supplier/{id}', 'editSupplier')->name('edit.supplier');
        Route::post('/update/supplier', 'updateSupplier')->name('supplier.update');
        Route::get('/delete/supplier/{id}', 'deleteSupplier')->name('delete.supplier');
        Route::get('details/supplier/{id}', 'detailsSupplier')->name('details.supplier');
    });
});

///Advance Salary Route
Route::controller(SalaryController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/add/advance/salary', 'addAdvanceSalary')->name('add.advance.salary');
        Route::post('/advance/salary/store', 'advanceSalaryStore')->name('advance.salary.store');
        Route::get('/all/advance/salary', 'allAdvanceSalary')->name('all.advance.salary');
        Route::get('/edit/advance/salary/{id}', 'editAdvanceSalary')->name('edit.advance.salary');
        Route::post('/advance/salary/update', 'advanceSalaryUpdate')->name('advance.salary.update');
        Route::get('/advance/salary/delete{id}', 'deleteAdvanceSalary')->name('delete.advance.salary');
    });
});

///Pay Salary All Route
Route::controller(SalaryController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/pay/salary', 'paySalary')->name('pay.salary');
        Route::get('pay/now/salary/{id}', 'payNowSalary')->name('pay.now.salary');
        Route::post('/employe/salary/store', 'employeSalaryStore')->name('employe.salary.store');
        Route::get('month/salary', 'monthSalary')->name('month.salary');
    });
});

/// All Attendence Route
Route::controller(AttendenceController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('employee/attend/list', 'employeeAttendenceList')->name('employee.attend.list');
        Route::get('/add/employee/attend', 'AddEmployeeAttendence')->name('add.employee.attend');
        Route::post('/employee/attend/store', 'employeeAttendenceStore')->name('employee.attend.store');
        Route::get('/edit/employee/attend/{date}', 'editEmployeeAttendence')->name('employee.attend.edit');
        Route::get('/view/employee/attend/{date}', 'viewEmployeeAttendence')->name('employee.attend.view');
    });
});

///All Category Route
Route::controller(CategoryController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::post('/store/category', 'storeCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');
    });
});

///All Product Route
Route::controller(ProductController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/product', 'allProduct')->name('all.product');
        Route::get('/add/product', 'addProduct')->name('add.product');
        Route::post('/store/product', 'storeProduct')->name('product.store');
        Route::get('/edit/product/{id}', 'editProduct')->name('edit.product');
        Route::post('/update/product', 'updateProduct')->name('product.update');
        Route::get('/delete/product/{id}', 'deleteProduct')->name('delete.product');
        Route::get('/barcode/product/{id}', 'barcodeProduct')->name('barcode.product');
        Route::get('/import/product', 'importProduct')->name('import.product');
        Route::get('/export', 'export')->name('export');
        Route::post('/import', 'import')->name('import');
    });
});

///All Expense Route
Route::controller(ExpenseController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/add/expense', 'addExpense')->name('add.expense');
        Route::post('/store/expense', 'storeExpense')->name('expense.store');
        Route::get('/today/expense', 'todayExpense')->name('today.expense');
        Route::get('/edit/expense/{id}', 'editExpense')->name('edit.expense');
        Route::post('/update/expense', 'updateExpense')->name('expense.update');
        Route::get('/month/expense', 'monthExpense')->name('month.expense');
    });
});

///All POS Route
Route::controller(PosController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/pos', 'pos')->name('pos');
        Route::post('add-cart', 'addCart');
        Route::get('/allitem', 'allItem');
        Route::post('/cart-update/{id}', 'cartUpdate');
        Route::get('/cart-remove/{id}', 'cartRemove');
        Route::post('create-invoice', 'createInvoice');
    });
});

///All Order Routes
Route::controller(OrderController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::post('/final-invoice', 'finalInvoice');
        Route::get('/pending/order', 'pendingOrder')->name('pending.order');
        Route::get('/order/details/{id}', 'orderDetails')->name('order.details');
        Route::post('/order/status/update', 'orderStatusUpdate')->name('order.status.update');
        Route::get('/complete/order', 'completeOrder')->name('complete.order');
        Route::get('/stock', 'stockManage')->name('stock.manage');
        Route::get('order/invoice-download/{id}', 'orderInvoice');

        Route::get('/pending/due', 'pendingDue')->name('pending.due');
        Route::get('order/due/{id}', 'orderDueAjax');
        Route::post('/update/due', 'updateDue')->name('update.due');
    });
});

///All Role Routes
Route::controller(RoleController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/permission', 'allPermission')->name('all.permission');
        Route::get('/add/permission', 'addPermission')->name('add.permission');
        Route::post('/store/permission', 'storePermission')->name('permission.store');
        Route::get('/edit/permission/{id}', 'editPermission')->name('edit.permission');
        Route::post('/update/permission', 'updatePermission')->name('permission.update');
        Route::get('/delete/permission/{id}', 'deletePermission')->name('delete.permission');
    });
});

///All Roles Route
Route::controller(RoleController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('all/roles', 'allRoles')->name('all.roles');
        Route::get('add/roles', 'addRoles')->name('add.roles');
        Route::post('/store/roles', 'storeRoles')->name('roles.store');
        Route::get('/edit/roles/{id}', 'editRoles')->name('edit.roles');
        Route::post('/update/roles', 'updateRoles')->name('roles.update');
        Route::get('/delete/roles/{id}', 'deleteRole')->name('delete.roles');
    });
});

/// Add Roles in permission 
Route::controller(RoleController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('add/roles/permission', 'addRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'storeRolePermission')->name('role.permission.store');
        Route::get('/all/role/permission', 'allRolePermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'adminEditRoles')->name('admin.edit.roles');
        Route::post('/role/permission/update/{id}', 'rolePermissionUpdate')->name('role.permission.update');
        Route::get('/admin/delete/roles/{id}', 'adminDeleteRoles')->name('admin.delete.roles');
    });
});

/// Admin User Routes
Route::controller(AdminController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/admin', 'allAdmin')->name('all.admin');
        Route::get('/add/admin', 'addAdmin')->name('add.admin');
        Route::post('/store/admin', 'storeAdmin')->name('admin.store');
        Route::get('/edit/admin/{id}', 'editAdmin')->name('edit.admin');
        Route::post('/update/admin', 'updateUser')->name('admin.update');
        Route::get('/delete/user/{id}', 'deleteUser')->name('delete.user');
    });
});
