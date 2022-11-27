<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\api\UsersRequest;

class UsersController extends ResponseController {

    /*
      User otp verification

      method : POST

      input : mobile_number=98563214774, login_type= 1:mobilenumber,2=google

      url : /api/login
     */

    public function login(UsersRequest $request): JsonResponse
    {
        try {

            $input_data=$request->validated();
            if((int) $input_data['login_type']==1){
                $mobile_number=$input_data['mobile_number'];
                $phone_code=$input_data['phone_code'];
                $user_details = User::where(['mobile_number' => $mobile_number, 'phone_code' => $phone_code,'role'=>3])->first();
                if(is_null($user_details)){
                    User::where(['mobile_number' => $mobile_number, 'phone_code' => $phone_code])->update(['otp'=>null]);
                    $otp = $this->_generateOtp();
                    $user_details=new User();
                    $user_details->otp=$otp;
                    $user_details->phone_code=$phone_code;
                    $user_details->mobile_number=$mobile_number;
                    $user_details->status=1;
                    $user_details->role=3;
                    $user_details->save();
                }
            }
            else{
                $google_token=$input_data['google_token'];
                $user_details = User::where(['google_token' => $google_token,'role'=>3])->first();
                if(is_null($user_details)){
                    $user_details=new User();
                    $user_details->google_token=$google_token;
                    $user_details->status=1;
                    $user_details->role=3;
                    $user_details->save();
                }
            }
            if((int)$user_details->status!=1){
                return $this->_sendErrorResponse("Please contact admin for approve.",[],400);
            }
            $user_details=Auth::loginUsingId($user_details->id);
            $user_details['token'] = $user_details->createToken('token')->accessToken;

            return $this->_sendResponse("Login successfully.", $user_details);
        } catch (Exception $e) {
            return $this->_sendErrorResponse("Unable to process.", $e->getMessage(), 500);
        }
    }

    /*
      User otp verification

      method : POST

      input : otp=123456

      url : /api/otp_verification
     */

    public function otp_verification(UsersRequest $request): JsonResponse
    {
        try {
            $otp=(int) trim($request->otp);
            $phone_code=(int) $request->phone_code;
            $mobile_number=(int) $request->mobile_number;
            $user_id=$request->user_id;
            $user_details=[];
            $userObj = User::where(["status" => 1, "otp" => $otp,"phone_code"=>$phone_code,"mobile_number"=>$mobile_number, "id" =>$user_id ,'role'=>3])->first();
            if ($userObj) {
                if ($userObj->otp == $otp) {
                    $userObj->otp = null;
                    $userObj->save();
                    $user_details = User::findOrFail($userObj->id);
                }
                else{
                    return $this->_sendErrorResponse("Please enter valid otp.",[],400);
                }
            }
            else{
                return $this->_sendErrorResponse("Please enter valid details.",[],400);
            }
            return $this->_sendResponse("OTP Verified Successfully.", $user_details);
        } catch (Exception $e) {
            return $this->_sendErrorResponse("Unable to process.", $e->getMessage(), 500);
        }
    }

    /*
      User resend otp

      method : POST

      input : mobile_number=9876541235

      url : /api/resend_otp
     */

    public function resend_otp(UsersRequest $request): JsonResponse
    {
        try {
            $user_details = User::where(["status" => 1, 'phone_code' => $request->phone_code, "mobile_number" => $request->mobile_number])->first();
            if (is_null($user_details)) {
                return $this->_sendErrorResponse("Invalid mobile number and phone code", $request->all(), 200);
            }
            $userObj = User::where(["status" => 1, "id" => $user_details->id])->first();
            if ($userObj) {
                $otp = $this->_generateOtp();

                $userObj->otp = $otp;
                if ($userObj->save()) {
                    $user_details['otp'] = $otp;
                    return $this->_sendResponse("OTP.", $user_details);
                } else {
                    return $this->_sendErrorResponse("There was an error sending OTP.", $request->all());
                }
            } else {
                return $this->_sendErrorResponse("No Data Found.", $request->all(), 400);
            }
        } catch (Exception $e) {
            return $this->_sendErrorResponse("Unable to process.", $e->getMessage(), 500);
        }
    }

    /*
      Get User profile

      method : GET

      input :

      url : /api/get_profile
     */

    public function get_profile(Request $request) {
        try {
            $userObj = User::where(['status'=>1,'id'=>$request->user()->id,'role'=>3])->first();
            return $this->_sendResponse("Profile details retrieved successfully.", $userObj);
        } catch (Exception $e) {
            return $this->_sendErrorResponse("Unable to process.", $e->getMessage(), 500);
        }
    }

    public function update_user_details(UsersRequest $request)
    {
        try {
            $data=[];
            $input_data=$request->validated();
            if(isset($input_data['google_token'])){
                $data['google_token']=$input_data['google_token'];
            }
            if(isset($input_data['first_name'])){
                $data['first_name']=$input_data['first_name'];
            }
            if(isset($input_data['last_name'])){
                $data['last_name']=$input_data['last_name'];
            }
            if(isset($input_data['email'])){
                $data['email']=$input_data['email'];
            }
            if(isset($input_data['birth_date'])){
                $data['birth_date']=$input_data['birth_date'];
            }
            if(isset($input_data['profile_picture'])){
                $image = request()->file('profile_picture');
                $file_name = time() . "_" . rand(0000, 9999) . '.' . $image->getClientOriginalExtension();
                $destinationPath = 'uploads/users';
                $image->move($destinationPath,$image->getClientOriginalName());
                $data['profile_picture']=$file_name;
            }
            $auth_id=$request->user()->id;
            if(count($data)>0){
                User::where('id',$auth_id)->update($data);
            }
            return $this->_sendResponse("Profile details updated successfully.",Auth::user());
        } catch (Exception $e) {
            return $this->_sendErrorResponse("Something went wrong", $e->getMessage(), 500);
        }
    }


    /*
      Generate OTP For Forgot Password Verification
     */

    public function _generateOtp(): int
    {
        return rand(100000, 999999);
    }
}
