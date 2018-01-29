<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

/*
 *  code         message
 *  001         success
 *  002         fail
 */

class Users extends REST_Controller
{

    /*
     * Put method to create the user
     */
    public function register_post()
    {
        $userName = $this->post('userName');
        $userPassword = $this->post('userPassword');
        $userEmail = $this->post('userEmail');

        if (!$userName || !$userPassword || !$userEmail) {
            $this->response("Enter complete user information to save", 200);
        } else {

            $isValidEmail = $this->UserModel->emailCheck($userEmail);

            if ($isValidEmail) {
                $result = $this->UserModel->registerUser(array("userName" => $userName, "userPassword" => md5($userPassword),
                    "userEmail" => $userEmail));
                if ($result === 0) {
                    $result = array("message" => "Error", "code" => "001");
                    $this->response($result, 200);
                } else {
                    $result = array("message" => "Success", "code" => "001");
                    $this->response($result, 200);
                }
            } else {
                $result = array("message" => "Email already found", "code" => "001");
                $this->response($result, 200);
            }
        }
    }

    /*
     * Post method to check the credentials
     */
    public function login_post()
    {
        $userName = $this->post('userName');
        $userPassword = $this->post('userPassword');

        if (!$userName || !$userPassword) {
            $result = array("message" => "Please enter valid data", "code" => "001");
            $this->response($result, 200);
        } else {
            $result = $this->UserModel->loginUser($userName, md5($userPassword));
            if ($result != "") {
                $this->response($result, 200);
            } else {
                $result = array("message" => "Error credentials", "code" => "001");
                $this->response($result, 200);
            }
        }
    }

}
