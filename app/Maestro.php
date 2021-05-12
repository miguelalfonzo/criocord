<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use PDO;

class Maestro extends Model
{   
    

	protected  static $pdo;

 	protected function __construct()

	{
    	static::$pdo = DB::getPdo();
	}

    
    

	protected static function list_categoria(){

   		//aplica tambien para clase de cliente
   		
		$p1 = Auth::user()->empresa;

        
	
		$stmt = static::$pdo->prepare("begin WEB_CLIENTES_CLASE(:p1, :c); end;");
		$stmt->bindParam(':p1', $p1, PDO::PARAM_STR);
	
		$stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
		
		$stmt->execute();

		oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);
        

        $result = array();

        foreach ($list as $value) {
        	
        	$result[] = array("id"=>$value["CLASE_CLIENTES"],"text"=>$value["DESCRIPCION"]);
        }
        
        return $result;

        

    
    }
    
    protected static function list_tipo_documento(){

   
	
		$stmt = static::$pdo->prepare("begin WEB_CLIENTES_DOCUMENTOS(:c); end;");
		
		$stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
		
		$stmt->execute();

		oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);
        
        $result =array();

        foreach ($list as $value) {
        	
        	$result[] = array("id"=>$value["CODIGO_DOCUMENTO"],"text"=>$value["DESCRIPCION"]);
        }
        
        return $result;

    
    }

    
    
    protected static function list_estado_civil(){

   
	
		$stmt = static::$pdo->prepare("begin WEB_CLIENTE_ESTADO_CIVIL(:c); end;");
		
		$stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
		
		$stmt->execute();

		oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);
        
        $result =array();

        foreach ($list as $value) {
        	
        	$result[] = array("id"=>$value["ESTADO_CIVIL"],"text"=>$value["DESCRIPCION"]);
        }
        
        return $result;

    
    }

    protected static function list_ocupacion(){

		$p1 = '';
	
		$stmt = static::$pdo->prepare("begin WEB_CLIENTES_OCUPACION(:p1, :c); end;");
		$stmt->bindParam(':p1', $p1, PDO::PARAM_STR);
	
		$stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
		
		$stmt->execute();

		oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);
        
        $result =array();

        foreach ($list as $value) {
        	
        	$result[] = array("id"=>$value["CODIGO_CARGO"],"text"=>$value["NOMBRE_CARGO"]);
        }
        
        return $result;

    
    }
   

    protected static function list_paises(){

		$p1 = '';
	
		$stmt = static::$pdo->prepare("begin WEB_CLIENTES_PAISES(:p1, :c); end;");
		
		$stmt->bindParam(':p1', $p1, PDO::PARAM_STR);
	
		$stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
		
		$stmt->execute();

		oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);
        
        $result = array();

        foreach ($list as $value) {
        	
        	$result[] = array("id"=>$value["CODIGO_PAIS"],"text"=>$value["NOMBRE"]);
        }
        
        return $result;

    
    }


    protected static function list_departamento(){

		$stmt = static::$pdo->prepare("begin WEB_CLIENTES_DEPARTAMENTO(:c); end;");
		
		$stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
		
		$stmt->execute();

		oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);
        
        $result =array();

        foreach ($list as $value) {
        	
        	$result[] = array("id"=>$value["DEPARTAMENTO"],"text"=>$value["DEPARTAMENTO"]);
        }
        
        return $result;

    
    }



    protected static function filter_ubigeo($request){

		$p1 = $request->get('q');
	
		$stmt = static::$pdo->prepare("begin WEB_CLIENTES_UBIGEO(:p1, :c); end;");
		
		$stmt->bindParam(':p1', $p1, PDO::PARAM_STR);
	
		$stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
		
		$stmt->execute();

		oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);
        
        $result =array();

        foreach ($list as $value) {
            
            $result[] = array("id"=>$value["CODIGO_UBIGEO"],"text"=>$value["FULL_UBIGEO"]);
        }
        
        return $result;

    
    }

    protected static function filter_cliente($request){

        $p1 = Auth::user()->empresa;

        $p2 = $request->get('q');
        
        $stmt = static::$pdo->prepare("begin WEB_CLIENTES_AUTOCOMPLETAR(:p1,:p2, :c); end;");
        
        $stmt->bindParam(':p1', $p1, PDO::PARAM_STR);
        $stmt->bindParam(':p2', $p2, PDO::PARAM_STR);

        $stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
        
        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);
        
        $result =array();

        foreach ($list as $value) {
            
            $result[] = array("id"=>$value["IDENTIFICACION"],"text"=>$value["NOMBRE"]);
        }
        
        return $result;

    
    }
}
