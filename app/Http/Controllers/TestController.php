<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Traits\ZBooks;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class TestController extends Controller
{
    public function index() : View{
        // ZBooks::setUpBeforeClass();
        
        $data = [
            'contact_name'=> 'Padme Amidala',
            'contact_type'=> 'vendor',
            'customer_sub_type' => 'individual',
        ];
        
        $Zoho = new Zbooks();
        $Zoho->setUpBeforeClass();
        $message= $Zoho->canCreateCustomer($data);

        return view('testView')->with('message', $message);
    }
}
