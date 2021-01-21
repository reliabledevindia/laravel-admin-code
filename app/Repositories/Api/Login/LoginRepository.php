<?php

namespace App\Repositories\Api\Login;

use DB,Mail;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;

class LoginRepository implements LoginRepositoryInterface {

    function __construct(User $User) {
       $this->User = $User;
    }

    public function login($request)
    {
        $errors =  $this->validator($request->all(), $this->rules());
        $data['status_code'] = 400;
        if($errors){
            $data['data'] = $errors->original;
            return $data;
        } 
        $chkEmail = $this->User->where('email',trim($request->email))->first();
        $response['status_code'] = 200;
        if($chkEmail){
          if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
              $user = Auth::user();
              $response['message'] = trans('flash.success.account_successfully_login');
              $response['data']['token_type'] = 'Bearer';
              $response['data']['access_token'] = trim($user->createToken('MobieAPI')->accessToken);
              $response['data']['user_id'] = trim($user['id']);
              $response['data']['slug'] = trim($user['slug']);
              $response['data']['username'] = trim($user['username']);
              $response['data']['name'] = trim($user['name']);
              $response['data']['email'] = trim($user['email']);
              $response['data']['created_at'] = trim($user['created_at']);
          }else{
              $response['status_code'] = 400;
              $response['message'] = 'Password not match';
          }
        }else{
          $response['status_code'] = 400;
          $response['message'] = 'Email do not match in record';
        }
        return $response;
    }

    /**
     * Get the Register validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'password' => "required|min:8",
            'email'=> "required|email"
        ];
    }
 
    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function validator($request,$rules)
    {
        $validator = Validator::make($request, $this->rules());
        if ($validator->fails()) {
            foreach ($validator->messages()->toArray() as $name =>$error) {
                $errors[$name] =  $error[0];
            }
            return response(
              $errors,
              500
            );
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
