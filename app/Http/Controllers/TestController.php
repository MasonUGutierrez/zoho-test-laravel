<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Traits\ZBooks;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class TestController extends Controller
{
    public function index() : RedirectResponse{
        ZBooks::setUpBeforeClass();
        
        $data = [
            'contact_name'=> 'Mason Urbina'
        ];
        
        $Zoho = new Zbooks();
        $message= $Zoho->canCreateCustomer($data);

        return redirect('/test')->with('message', $message);
    }
}
