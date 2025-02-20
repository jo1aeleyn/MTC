<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FinancialRequestController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\ClientAssignmentController;
use App\Http\Controllers\CompanyPositionController;
use App\Http\Controllers\EventController;


Route::get('/', [AuthController::class, 'showLoginForm']);

Route::middleware('auth')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employees/{uuid}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::patch('/employees/{uuid}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/{uuid}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::patch('/employees/{uuid}/archive', [EmployeeController::class, 'archive'])->name('employee.archive');
});

Route::get('employees/export', [EmployeeController::class, 'export'])->name('employee.export');
 Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');

Route::get('employees/export', [EmployeeController::class, 'export'])->name('employee.export');
 Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Route
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfilePage'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/{uuid}', [AuthController::class, 'update'])->name('profile.updatepicture');

});

Route::prefix('users')->middleware('auth')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{uuid}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{uuid}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{uuid}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
});
Route::post('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');

// Forgot Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index'); // List all clients
    Route::get('/create', [ClientController::class, 'create'])->name('clients.create'); // Show create form
    Route::post('/store', [ClientController::class, 'store'])->name('clients.store'); // Store client
    Route::get('/{uuid}', [ClientController::class, 'show'])->name('clients.show'); // Show single client
    Route::get('/{uuid}/edit', [ClientController::class, 'edit'])->name('clients.edit'); // Show edit form
    Route::put('/{uuid}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/{uuid}/archive', [ClientController::class, 'archive'])->name('clients.archive'); // Archive client
});

Route::middleware(['auth'])->group(function () {
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/Company Announcement', [AnnouncementController::class, 'companyannouncements'])->name('announcements.companyannouncements');
    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
    Route::get('/announcements/{uuid}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/announcements/{uuid}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
    Route::post('/announcements/{announcement}/archive', [AnnouncementController::class, 'archive'])->name('announcements.archive');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/overtime/{overtime:uuid}/status/{status}', [OvertimeController::class, 'updateStatus'])->name('overtime.update_status');
    Route::put('/overtime/{overtime:uuid}/cancel', [OvertimeController::class, 'cancel'])->name('overtime.cancel');
    Route::post('/overtime/{overtime:uuid}/archive', [OvertimeController::class, 'archive'])->name('overtime.archive');
    Route::get('overtime', [OvertimeController::class, 'index'])->name('overtime.index');
    Route::get('overtime/personalindex', [OvertimeController::class, 'personalindex'])->name('overtime.personalindex');
    Route::get('overtime/create', [OvertimeController::class, 'create'])->name('overtime.create');
    Route::post('overtime', [OvertimeController::class, 'store'])->name('overtime.store');
    Route::get('overtime/{overtime:uuid}', [OvertimeController::class, 'show'])->name('overtime.show');
    Route::get('overtime/{overtime:uuid}/edit', [OvertimeController::class, 'edit'])->name('overtime.edit');
    Route::put('overtime/{overtime:uuid}', [OvertimeController::class, 'update'])->name('overtime.update');
    Route::delete('overtime/{overtime:uuid}', [OvertimeController::class, 'destroy'])->name('overtime.destroy');

    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{uuid}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/{uuid}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::post('/departments/{uuid}', [DepartmentController::class, 'archive'])->name('departments.archive');
});

Route::put('/financial_req/{uuid}/cancel', [FinancialRequestController::class, 'cancel'])->name('financial_req.cancel');
Route::put('/financial-req/{uuid}/status/{status}', [FinancialRequestController::class, 'updateStatus'])->name('financial_req.update_status');
Route::get('/financial-req', [FinancialRequestController::class, 'index'])->name('financial_req.index');
Route::get('/financial-req/personalindex', [FinancialRequestController::class, 'personalindex'])->name('financial_req.personalindex');
Route::get('/financial-req/create', [FinancialRequestController::class, 'create'])->name('financial_req.create');
Route::post('/financial-req/store', [FinancialRequestController::class, 'store'])->name('financial_req.store');
Route::get('/financial-req/{uuid}', [FinancialRequestController::class, 'show'])->name('financial_req.show');
Route::get('/financial-req/{uuid}/edit', [FinancialRequestController::class, 'edit'])->name('financial_req.edit');
Route::put('/financial-req/{uuid}', [FinancialRequestController::class, 'update'])->name('financial_req.update');
Route::delete('/financial-req/{uuid}', [FinancialRequestController::class, 'destroy'])->name('financial_req.destroy');
Route::put('/financial_req/{financialRequest}/archive', [FinancialRequestController::class, 'archive'])->name('financial_req.archive');

Route::prefix('leaves')->group(function () {
    Route::get('/', [LeavesController::class, 'index'])->name('leaves.index'); // List of leaves
    Route::get('/PersonalLeaves', [LeavesController::class, 'PersonalLeaves'])->name('leaves.PersonalLeaves');
    Route::get('/create', [LeavesController::class, 'create'])->name('leaves.create'); // Show create form
    Route::post('/store', [LeavesController::class, 'store'])->name('leaves.store'); // Store leave application
    Route::get('/{uuid}/edit', [LeavesController::class, 'edit'])->name('leaves.edit');
    Route::put('/{uuid}/show', [LeavesController::class, 'show'])->name('leaves.show'); 
    Route::put('/{uuid}', [LeavesController::class, 'update'])->name('leaves.update');
    Route::get('/{uuid}', [LeavesController::class, 'show'])->name('leaves.show'); // Show leave details
    Route::put('/{uuid}/archive', [LeavesController::class, 'archive'])->name('leaves.archive');
    Route::put('/leave_requests/{uuid}/update_status/{status}', [LeavesController::class, 'updateStatus'])->name('leave_requests.update_status');
    Route::put('/leave_requests/{uuid}/cancel', [LeavesController::class, 'cancel'])->name('leaves.cancel');
    Route::put('/leave-credits/{uuid}', [LeavesController::class, 'leavestore'])->name('leave.credits.store');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/client-assignment', [ClientAssignmentController::class, 'index'])->name('client.assignment.index');
    Route::get('/client-assignment/create', [ClientAssignmentController::class, 'create'])->name('client.assignment.create');
    Route::post('/client-assignment', [ClientAssignmentController::class, 'store'])->name('client.assignment.store');
    Route::get('/client-assignment/{uuid}/edit', [ClientAssignmentController::class, 'edit'])->name('client.assignment.edit');
    Route::put('/client-assignment/{uuid}', [ClientAssignmentController::class, 'update'])->name('client.assignment.update');
    Route::put('/client-assignment/archive/{uuid}', [ClientAssignmentController::class, 'archive'])->name('client.assignment.archive');
});

Route::prefix('company-positions')->group(function () {
    Route::get('/', [CompanyPositionController::class, 'index'])->name('company_positions.index'); // List all positions
    Route::get('/create', [CompanyPositionController::class, 'create'])->name('company_positions.create'); // Show create form
    Route::post('/store', [CompanyPositionController::class, 'store'])->name('company_positions.store'); // Store new position
    Route::get('/company-positions/edit/{uuid}', [CompanyPositionController::class, 'edit'])->name('company_positions.edit');
    Route::put('/company-positions/update/{uuid}', [CompanyPositionController::class, 'update'])->name('company_positions.update');
    Route::post('/{uuid}/archive', [CompanyPositionController::class, 'archive'])->name('company_positions.archive');
});


Route::get('/calendar', [EventController::class, 'index'])->name('calendar.index');
Route::get('/events/get', [EventController::class, 'getEvents'])->name('events.get');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::get('events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');

Route::post('events/update/{id}', [EventController::class, 'update'])->name('events.update');
Route::put('/events/archive/{id}', [EventController::class, 'archive'])->name('events.archive');

