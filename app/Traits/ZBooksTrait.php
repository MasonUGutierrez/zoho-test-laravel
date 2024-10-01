<?php

namespace App\Traits;

trait ZBooksTrait{
    // public function getListOfOrganizations(ZohoBooks $zoho)
    public function getListOfOrganizations()
    {
        return $this->zoho->orgranizations->getList();
    }

    // public function canCreateCustomer(ZohoBooks $zoho, $data = null)
    public function canCreateCustomer(?array $data = null)
    {
        $message='';

        if(isset($data))
        {
            // var_dump($this->zoho);
            $customer = $this->zoho->contacts->create($data);             
            // var_dump($customer);
        }

        $customers = $this->zoho->contacts->getList([
            'contact_name'=>$customer->toArray()['contact_name']
        ]);

        (count($customers)>0)?$message="Contact has been created":$message="Something went wrong!";
        
        return $message;
    }
}
?>