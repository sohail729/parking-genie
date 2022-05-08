<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fileUpload($file, $path)
    {
        if($file){
            // $fileName = $file->getClientOriginalName(); 
            $newName = time().'.'.$file->extension(); 
            $file->move(public_path($path), $newName); 
            return $newName; 
        }
        return null;   
    }

}
