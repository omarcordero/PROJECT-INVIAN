<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
    public function getAllUsers(Request $request, $categoryId) {
        $user       = User::where('category_id', $categoryId)->get();

        $aResponse  = array(
                'status'    => true,
                'message'   => 'User query successfully',
                'result'    => $user
            );

        return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
    }

    public function createUser(Request $request) {
        $aRequest       = $request->all();
        $name           = (isset($aRequest['name'])) ? $aRequest['name'] : "";
        $lastname       = (isset($aRequest['lastname'])) ? $aRequest['lastname'] : "";
        $email          = (isset($aRequest['email'])) ? $aRequest['email'] : "";
        $gender         = (isset($aRequest['gender'])) ? $aRequest['gender'] : "";
        $categoryId     = (isset($aRequest['categoryId'])) ? $aRequest['categoryId'] : "";

        if ($name === "" || $lastname === "" || $email === "" || $gender === "") {
            $aResponse      = array(
                'status'    => false,
                'message'   => 'Fields required',
                'result'    => array()
            );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        } else {
            $user               = new User();
            $user->name         = $name;
            $user->lastname     = $lastname;
            $user->email        = $email;
            $user->gender       = $gender;
            $user->category_id  = $categoryId;
            $user->save();

            $aResponse      = array(
                'status'    => true,
                'message'   => 'User create successfully',
                'result'    => $user
            );

            return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
        }
    }

    public function deleteUser(Request $request, $userId) {
        $user = User::find($userId);
        
        if (isset($user)) {
            $user->delete();

            $aResponse      = array(
                'status'    => true,
                'message'   => 'Delete successfully',
                'result'    => $user
            );

            return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
        } else {
            $aResponse      = array(
                'status'    => false,
                'message'   => 'Parameter incorrect',
                'result'    => array()
            );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        }
    }

}
