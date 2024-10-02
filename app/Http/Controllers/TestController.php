<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Traits\ZBooks;

class TestController extends Controller
{
    public function index() : View{
        // ZBooks::setUpBeforeClass();
        
        $data = [
            'contact_name'=> 'R2D2',
            // 'contact_type'=> 'vendor',
            'customer_sub_type' => 'individual',
        ];
        
        $Zoho = new Zbooks();
        $Zoho->setUpBeforeClass();
        $message= $Zoho->canCreateVendor($data);

        return view('testView')->with('message', $message);
    }
}
