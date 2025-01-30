<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'uuid', 'emp_num', 'surname', 'first_name', 'middle_name', 'nickname', 'birthdate',
        'birthplace', 'age', 'sex', 'civil_status', 'nationality', 'religion', 'blood_type',
        'address', 'contact_num', 'email', 'tin_num', 'sss_num', 'pag_ibig_num', 'philhealth_num',
        'tax_status', 'created_by', 'is_archived'
    ];

    /**
     * Get the user associated with the employee.
     */
    public function user()
    {
        return $this->hasOne(UserAccount::class, 'employee_id');
    }

    /**
     * Get the educational background associated with the employee.
     */
    public function educationalBackground()
    {
        return $this->hasOne(EducationalBackground::class, 'emp_num', 'emp_num');
    }

    /**
     * Get the employment history associated with the employee.
     */
    public function employmentHistory()
    {
        return $this->hasMany(EmploymentHistory::class, 'emp_num', 'emp_num');
    }

    /**
     * Get the training records associated with the employee.
     */
    public function training()
    {
        return $this->hasMany(Training::class, 'emp_num', 'emp_num');
    }

    /**
     * Get the family background records associated with the employee.
     */
    public function familyBackground()
    {
        return $this->hasMany(FamilyBackground::class, 'emp_num', 'emp_num');
    }

    /**
     * Get the emergency contact records associated with the employee.
     */
    public function emergencyContacts()
    {
        return $this->hasMany(EmergencyContact::class, 'emp_num', 'emp_num');
    }

    /**
     * Get the applications associated with the employee.
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'emp_num', 'emp_num');
    }
}
