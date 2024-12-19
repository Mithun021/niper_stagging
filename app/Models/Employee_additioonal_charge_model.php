<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_additioonal_charge_model extends Model
    {
        protected $table         = 'employees';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','designation_id','upload_by'];
        // protected $createdField  = 'created_at';

        public function updateEmployeeDesignations(int $employeeId, array $designations)
        {
            // Fetch existing designations for the employee
            $existing = $this->where('employee_id', $employeeId)
                            ->findAll();

            $existingIds = array_column($existing, 'designation_id');

            // Determine new designations to insert
            $toInsert = array_diff($designations, $existingIds);

            // Determine designations to delete
            $toDelete = array_diff($existingIds, $designations);

            // Insert new designations
            if (!empty($toInsert)) {
                $insertData = [];
                foreach ($toInsert as $designationId) {
                    $insertData[] = [
                        'employee_id'    => $employeeId,
                        'designation_id' => $designationId,
                    ];
                }
                $this->insertBatch($insertData);
            }

            // Delete unchecked designations
            if (!empty($toDelete)) {
                $this->where('employee_id', $employeeId)
                    ->whereIn('designation_id', $toDelete)
                    ->delete();
            }
        }
        
    }
?>