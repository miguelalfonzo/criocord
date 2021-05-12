<?php


namespace App\Http\Controllers\Mantenimiento; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Maestro;
use App\User;
use Auth;
use Peru\Jne\DniFactory;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }
    
  	
	
	 public function index(){      

	 	$empresa_user = Auth::user()->empresa;

	 	$cargos = Maestro::list_ocupacion();


		return View('usuario.index',compact('empresa_user','cargos'));

	}

	 
	protected function list_usuarios(Request $request){      

		

		$list = User::list_usuarios($request);

		return response()->json($list);

	}


	protected function get_item_usuario(Request $request){      

		if($request->dni==0){

			$list =array(array('IDENTIFICACION'=>'',
								'NOMBRES'=>'',
								'APEPAT'=>'',
								'APEMAT'=>'',
								'DIRECCION'=>'',
								'TELEFONO'=>'',
								'EMAIL'=>'',
								'PASSWORD'=>'',
								'CARGO'=>'',
								'FLAG_ACTIVO'=>1));
		}else{

			$list = User::get_item_usuario($request);
		}

		

		return response()->json($list);

	}
	
	

	protected function save_usuario(Request $request){      

		DB::beginTransaction();

        try {

           $valida_usuario = $this->valida_usuario($request);
           
           if($valida_usuario["status"] == "ok"){

                $rpta = User::save_usuario($request);
            
                if($rpta == 1){

                    DB::commit();

                    return $this->setRpta("ok","Se procesó correctamente");

                }
          
                DB::rollback();

                return $this->setRpta("error","Ocurrió un error");

           }

           return $valida_usuario;
           

        } catch (\Exception $e) {
            
            DB::rollback();

            return $this->setRpta("error",$e->getMessage());
        }

		

	}

	

	protected function api_item_usuario(Request $request){      

		

		$data = User::get_item_usuario($request);

        if(count($data) == 0){

          return $this->search_api($request);

        }

        return $this->setRpta("ok","Consulta ejecutada exitosamente",$data);

	}

	public function search_api($request) 
   {  

      $dni = trim($request->dni);

      require '../vendor/autoload.php';
    
      $factory = new DniFactory();

      $cs = $factory->create();

      $person = $cs->get($dni);

      if (!$person) {
        
          return $this->setRpta("error","No se encontraron registros");

      }else{

        
      	$data =array(array('IDENTIFICACION'=>$dni,
								'NOMBRES'=>$person->nombres,
								'APEMAT'=>$person->apellidoMaterno,
								'APEPAT'=>$person->apellidoPaterno,
								'DIRECCION'=>'',
								'TELEFONO'=>'',
								'EMAIL'=>'',
								'PASSWORD'=>'',
								'CARGO'=>'',
								'FLAG_ACTIVO'=>1));
      

        return $this->setRpta("ok","Consulta Exitosa de Reniec",$data);
      }

    
       

        
    }


	protected function valida_usuario($request){
       

        $empresa = '001';

        $rules = [
            
           'vm_usuario_dni'=> 'required',
           'vm_usuario_nombre'=> 'required',
           'vm_usuario_apepat'=> 'required',
           'vm_usuario_apemat'=> 'required',
           //'vm_usuario_correo'=> 'required|email|unique:users,email,'.$request->vm_usuario_dni,
           'email' => ['required', 'email', Rule::unique('users')->ignore($request->vm_usuario_dni, 'identificacion')],
           'vm_usuario_cargo'=> 'required'
           
            
        ];

        $messages = [

        	'vm_usuario_dni.required' => 'El N° de documento es obligatorio.',
            'vm_usuario_nombre.required' => 'El Nombre es obligatorio.',
            'vm_usuario_apepat.required' => 'El A.Paterno es obligatorio.',
            'vm_usuario_apemat.required' => 'El A.Materno es obligatorio.',
            'email.required' => 'El Correo es obligatorio.',
            'email.email' => 'Ingrese un correo valido.',
            'vm_usuario_cargo.required' => 'El Cargo es obligatorio.',
            'email.unique' => 'El Correo ya se encuentra registrado.'
            
            
        ];

       
         $validate = \Validator::make($request->all(),$rules,$messages);

         if ($validate->fails())
         {   
            
            return $this->setRpta("warning",$this->msgValidator($validate),$validate->messages() );

         }
        

        return $this->setRpta("ok","valido inputs cliente");


    }
    
}

