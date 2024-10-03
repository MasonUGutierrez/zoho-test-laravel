<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Traits\ZBooks;

class TestController extends Controller
{
    public function index() : View{
        // ZBooks::setUpBeforeClass();
        
        $data = [
            'contact_name'=> 'C3PO',
            // 'contact_type'=> 'vendor',
            'customer_sub_type' => 'individual',
        ];
        
        // $Zoho = new Zbooks();
        // $Zoho->setUpBeforeClass();
        $zoho = ZBooks::setupClass();
        $message= $zoho->canCreateVendor($data);

        return view('testView')->with('message', $message);
    }
}
