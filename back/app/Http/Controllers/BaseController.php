<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseController extends Controller
{
    public function sendOkResponse($data, $code = 200)
    {
        return response()->json(
            [
                'success' => true,
                'data' => $data
            ],
            $code
        );
    }

    public function sendErrorResponse($errors, $code = 400)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'errors' => $errors
                ],
                $code
            )
        );
    }

    public function validateId(string $tb, $id)
    {
        $validator = Validator::make(
            ['id' => $id],
            ['id' => "exists:{$tb},id"],
            ['id.exists' => "id introuvable"]
        );

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors());
        }
    }


    public function unique(string $table, $column, $value , $id=null)
    {
        $validator = Validator::make(
            ["{$column}" => $value],
            ["{$column}" => "unique:{$table},{$column}" . ($id === null ? "" : ",{$id}")], 
            ["{$column}.unique" => "Email token"]
        );
        
        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors());
        }
    }
}

