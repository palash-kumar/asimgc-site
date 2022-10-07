<?php

namespace App\Models\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public static function jsonResponse($statusCode, $status, $remarks, $data){
        return response()->json(['statusCode'=> $statusCode, 'status'=> $status, 'remarks'=>$remarks, 'data'=>$data]);
    }
}
