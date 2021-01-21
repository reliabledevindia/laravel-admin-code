<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\Api\Register\RegisterRepositoryInterface as RegisterRepo;

class RegisterController extends BaseController
{
      public function __construct(RegisterRepo $RegisterRepo)
      {
        $this->RegisterRepo = $RegisterRepo;
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $response = $this->RegisterRepo->register($request);
        return $this->response->array($response);
    }
}