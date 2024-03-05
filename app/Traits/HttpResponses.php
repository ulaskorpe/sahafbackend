<?php 

namespace App\Traits;

trait HttpResponses{
    protected function success($data,$message=null,$code = 200){

            return response()->json([
                'status'=>'successfull',
                'message'=>$message,'data'=>$data
        
        ],$code);

    }
    private $allowed_array = ['jpg', 'jpeg'];
    protected function error($data,$message=null,$code){

        return response()->json([
            'status'=>'error',
            'message'=>$message,'data'=>$data
    
    ],$code);


    
}


}