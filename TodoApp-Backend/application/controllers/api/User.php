<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class User extends REST_Controller
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
                    $this->response("Error", 200);
                } else {
                    $this->response("Success", 200);
                }
            } else {
                $this->response("Email already found", 200);
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
            $this->response("Please enter valid data", 200);
        } else {
            $result = $this->UserModel->loginUser($userName, md5($userPassword));
            if ($result != "") {
                $this->response($result, 200);
            } else {
                $this->response("Error credentials", 200);
            }
        }
    }

}
