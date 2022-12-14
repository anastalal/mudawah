<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use App\Models\Passport\Token;
use Validator;
//use App\User;
use App\Models\User;
use Auth;
class UsersController extends Controller
{

    public function index(){
      //  return "hello world";
        return  dd( User::all());
    }
    public function users(){
        return  User::all();
    }
 public function login(){
  if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
   $user = Auth::user();
   $success['token'] = $user->createToken('appToken')->accessToken;
   return response()->json([
    'success' => true,
    'token' => $success,
    'user' => $user,
   ]);
  } else{
   return response()->json([
    'success' => false,
    'message' => 'Invalid Email or Password',
   ], 401);
  }
 }
 public function register(Request $request){
    $validator = Validator::make($request->all(), [
     'name' => ['required', 'string', 'max:255'],
     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
     'password' => ['required', 'string', 'min:8'],
    ]);
    if($validator->fails()){
     return response()->json([
      'success' => false,
      'message' => $validator->errors(),
     ], 401);
    }
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    //$user = Auth::user();
    //$success['token'] = $user->createToken('appToken')->accessToken;
    $success['token'] = $user->createToken('appToken')->accessToken;
    //$token = $user->createToken('authToken')->accessToken;
    return response()->json([
     'success' => true,
     'token' => $success,
     'user' => $user
    ]);
   }
   public function logout(Request $request){
    if(Auth::user()){
     $user = Auth::user()->token();
     $user->revoke();
  return response()->json([
      'success' => true,
      'message' => 'Logout successfully',
     ]);
    } else{
     return response()->json([
      'success' => false,
      'message' => 'Unable to Logout',
     ]);
    }
   }
}
