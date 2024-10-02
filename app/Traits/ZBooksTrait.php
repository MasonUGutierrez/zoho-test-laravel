<?php

namespace App\Traits;

trait ZBooksTrait{
    public function getListOfOrganizations()
    {
        return $this->zoho->orgranizations->getList();
    }

    public function canCreateCustomer(?array $data = null)
    {
        $message='';

        if(isset($data))
        {
            $customer = $this->zoho->contacts->create($data);             
        }    
        ($this->checkIfSaved($customer, 'contacts', 'contact_name'))?$message="Contact has been created":$message="Something went wrong!";
        return $message;
    }

    public function canCreateVendor(?array $data = null)
    {
        $message='';

        if(!isset($data['contact_type']))
        {
            $data['contact_type'] = 'vendor';
        }
        $vendor = $this->zoho->contacts->create($data);
        ($this->checkIfSaved($vendor,'contacts','contact_name'))?$message="Vendor has been created":$message="Something went wrong!";
        return $message;
    }

    /**
     * Function to verified if a new register had done
     *
     * @param [type] $search - model to verify recently modified
     * @param string $module - module modified
     * @param string $value  - property of the model that will be used to check
     * @return void
     */
    private function checkIfSaved($search = null, string $module, string $value)
    {
        $list = $this->zoho->$module->getList([
            $value => $search->toArray()[$value]
        ]);
        
        if(count($list)>0)
            return 1;
        else 
            return 0;
    }
}
?>