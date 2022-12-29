<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function test (Request $req){


        $validator = Validator::make($req->all(), [
            'name'=>'required',
            'age'=>['required', 'numeric']
        ], [
            'name.required'=>'Required name',
            'age.required'=>'Required age',
            'age.numeric'=>'Age is number',
        ]);

          if ($validator->fails()) {
              return response([
                'errors' => $validator->messages()->first(),
                'errors1' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST,
              ], Response::HTTP_BAD_REQUEST);
          }

          return response([
            'message' => 'success',
            'status' => Response::HTTP_CREATED,
          ], Response::HTTP_CREATED);

        //   MODEL::create($validator->validated());

        //   return response()->json([
        //     'data'   => [],
        //     'status' => Response::HTTP_CREATED,
        //   ], Response::HTTP_CREATED);
        // return response([
        //     'message'=>'success',
        //     'data'=>'123'
        // ]);
    }
}
