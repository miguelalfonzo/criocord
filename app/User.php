<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;
use PDO;

class User extends Authenticatable
{
    use Notifiable;

    protected static function list_usuarios($request){

        $p1 = Auth::user()->empresa;

        $p2 = $request->flag_activo;
    
        $stmt = DB::getPdo()->prepare("begin WEB_USUARIOS_LISTADO(:p1,:p2, :c); end;");
        $stmt->bindParam(':p1', $p1, PDO::PARAM_STR);
        $stmt->bindParam(':p2', $p2, PDO::PARAM_STR);
        $stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
        
        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);

        return $list;

    }

    protected static function get_item_usuario($request){

        $p1 = Auth::user()->empresa;

        $p2 = $request->dni;
    
        $stmt = DB::getPdo()->prepare("begin WEB_USUARIO_GETITEM(:p1,:p2, :c); end;");
        $stmt->bindParam(':p1', $p1, PDO::PARAM_STR);
        $stmt->bindParam(':p2', $p2, PDO::PARAM_STR);
        $stmt->bindParam(':c', $cursor, PDO::PARAM_STMT);
        
        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);
        oci_fetch_all($cursor, $list, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC );
        oci_free_cursor($cursor);

        return $list;

    }


    protected static function save_usuario($request){

        $empresa   = Auth::user()->empresa;
        $nombres   = $request->vm_usuario_nombre; 
        $apepat    = $request->vm_usuario_apepat; 
        $apemat    = $request->vm_usuario_apemat; 
        $dni       = $request->vm_usuario_dni; 
        $direccion = $request->vm_usuario_direcion; 
        $telefono  = $request->vm_usuario_telefono; 
        $correo    = $request->vm_usuario_correo; 

        $password  = (empty($request->vm_usuario_password))?bcrypt(str_random(8)):$request->vm_usuario_password; 

        $cargo     = $request->vm_usuario_cargo; 
        $estado    = $request->vm_usuario_estado; 
        $do_usuario = $request->flag_otra_empresa; 
        $imagen     = '';

        $stmt = static::$pdo->prepare("begin WEB_USUARIOS_INPUPD(:p1,:p2,:p3,:p4,:p5,:p6,:p7,:rpta); end;");
        $stmt->bindParam(':p1', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':p2', $nombres, PDO::PARAM_STR);
        $stmt->bindParam(':p3', $apepat, PDO::PARAM_STR);
        $stmt->bindParam(':p4', $apemat, PDO::PARAM_STR);
        $stmt->bindParam(':p5', $dni, PDO::PARAM_STR);
        $stmt->bindParam(':p6', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':p7', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':p8', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':p9', $password, PDO::PARAM_STR);
        $stmt->bindParam(':p10', $cargo, PDO::PARAM_STR);
        $stmt->bindParam(':p11', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':p12', $do_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':p13', $imagen, PDO::PARAM_STR);
        $stmt->bindParam(':rpta', $rpta, PDO::PARAM_INT);
        $stmt->execute();

        
        return $rpta;

    }
}
