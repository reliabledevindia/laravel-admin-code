<?php

namespace App\Repositories\Api\Register;

use DB,Mail;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;

class RegisterRepository implements RegisterRepositoryInterface {

    function __construct(User $User) {
       $this->User = $User;
    }

    public function register($request)
    {
        $errors =  $this->validator($request->all(), $this->rules());
        $data['status_code'] = 400;
        if($errors){
            $data['data'] = $errors->original;
            return $data;
        }else{
            $user =  $this->User->createUser($request->all(),$request->get('role'));
            $response['status_code'] = 200;
            $response['message'] = trans('flash.success.account_created_successfully');
            $response['data']['token_type'] = 'Bearer';
            $response['data']['access_token'] = trim($user->createToken('MobieAPI')->accessToken);
            $response['data']['user_id'] = $user['id'];
            $response['data']['slug'] = trim($user['slug']);
            $response['data']['username'] = trim($user['username']);
            $response['data']['name'] = trim($user['name']);
            $response['data']['email'] = trim($user['email']);
            $response['data']['created_at'] = trim($user['created_at']);
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
            'name' => 'required|string|max:255',
            'role' => 'required|in:user',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
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
