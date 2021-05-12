<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function setRpta($status,$description,$data=NULL){

        return array("status"=>$status,"description"=>$description,"data"=>$data);

    }

    public function msgValidator( $validator )
    {
        $rpta = '';
        foreach( $validator->messages()->all() as $msg )
        {
            $rpta .= $msg." ";
        }
        return substr( $rpta , 0 , -1 );
    }
}
