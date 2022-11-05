<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\api\UsersRequest;

class UsersController extends ResponseController {

    /*
      User otp verification

      method : POST

      input : mobile_number=98563214774

      url : /api/login
     */

    public function login(UsersRequest $request): JsonResponse
    {
        try {
            $mobile_number=$request->mobile_number;
            $otp = $this->_generateOtp();
            $user_details = User::where(['mobile_number' => $mobile_number, 'phone_code' => $request->phone_code, 'status' => 1])->first();
            if (is_null($user_details)) {
                return $this->_sendErrorResponse("Invalid mobile number", $request->all());
            }


            $user_details->otp = $otp;
            if ($user_details->save()) {
                $user_details['otp'] = $otp;
                $user_details['user_id'] = $user_details->user_id;

            }
            return $this->_sendResponse("Login successfully.", $user_details);
        } catch (Exception $e) {
            return $this->_sendErrorResponse("Unable to process.", $e->getMessage(), 500);
        }
    }

    /*
      User otp verification

      method : POST

      input : otp=123

      url : /api/otp_verification
     */

    public function otp_verification(UsersRequest $request): JsonResponse
    {
        try {
            $userObj = User::where(["status" => 1, "otp" => $request->otp, "id" => $request->user_id])->first();
            if ($userObj) {
                if ($userObj->otp == trim($request->otp)) {

                    //do not update otp for static mobile
                    $userObj->otp = null;
                    $userObj->save();

                    $user_details = User::findOrFail($userObj->id);
                }
            }
            return $this->_sendResponse("OTP.", $userObj);
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
            $patient_details = User::where(["status" => 1, 'phone_code' => $request->phone_code, "mobile_number" => $request->mobile_number])->first();
            if (is_null($patient_details)) {
                return $this->_sendErrorResponse("Invalid mobile number and phone code", $request->all(), 200);
            }
            $userObj = User::where(["status" => 1, "id" => $patient_details->user_id])->first();
            if ($userObj) {
                $otp = $this->_generateOtp();

                $userObj->otp = $otp;
                if ($userObj->save()) {
                    $user_details['otp'] = $otp;
                    $user_details['user_id'] = $patient_details->user_id;
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
      User registration

      method : POST

      input : email='abc@gmail.com', username='abc', password='123456789', country ='India',
      country_code=91, mobile_number='9874563211

      url : /api/registration
     */

    public function registration(UsersRequest $request): JsonResponse
    {
        try {
            $details=[];
            $otp = $this->_generateOtp();
            $user = new User;
            $user->username = $request->username;
            $user->full_name = $request->username;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->otp = $otp;
            $user->account_type = 2;
            $user->role_id = 5;
            $user->status = 1;
            if ($user->save()) {

                $details['user'] = User::with('get_patient_details')->findOrFail($user->id);
            }
            return $this->_sendResponse("Registration successfully.", $details['user']);
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
            $userObj = User::with('get_patient_details')->findOrFail($request->user()->id);


                return $this->_sendResponse("Profile details retrieved successfully.", $userObj);
        } catch (Exception $e) {
            return $this->_sendErrorResponse("Unable to process.", $e->getMessage(), 500);
        }
    }

    public function update_user_details(UsersRequest $request): JsonResponse
    {
        try {



            return $this->_sendResponse("Profile details updated successfully.");
        } catch (Exception $e) {
            return $this->_sendErrorResponse("Something went wrong", $e->getMessage(), 500);
        }
    }


    /*
      Generate OTP For Forgot Password Verification
     */

    public function _generateOtp(): int
    {
        return rand(1000, 9999);
    }
}
