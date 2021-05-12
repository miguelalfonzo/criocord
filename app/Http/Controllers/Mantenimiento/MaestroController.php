<?php


namespace App\Http\Controllers\Mantenimiento; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Maestro;


class MaestroController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }
    
  	
	
	 public function filter_ubigeo(Request $request)
	{      

		$list = Maestro::filter_ubigeo($request);
		
		return response()->json($list);

	}

	 public function filter_cliente(Request $request)
	{      

		$list = Maestro::filter_cliente($request);
		
		return response()->json($list);

	}

	

    
}

