<?php


namespace App\Http\Controllers\Cobranza; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Maestro;

class LlamadaController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
	{      

    
		return View('llamada.index');
		

	}	
	

	


    
}
