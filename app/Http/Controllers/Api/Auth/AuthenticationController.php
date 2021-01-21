<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\Api\Login\LoginRepositoryInterface as LoginRepo;

class AuthenticationController extends BaseController
{
    public function __construct(LoginRepo $LoginRepo)
    {
        $this->LoginRepo = $LoginRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    { 
        try{
           $response = $this->LoginRepo->login($request);
           return $this->response->array($response);
        }
        catch (\Exception $e)
        {
            return $this->ValidateHeader();
        }
    }

  /**
   * return unathentication message with error code 500
   * @return \Illuminate\Http\Response
   */
    public function ValidateHeader()
    {
      return $this->response->array(["message"=>"Unauthenticated","status_code"=>500])->setStatusCode(500);
    }
}