<?php

/**
 * Created by PhpStorm.
 * UserController: Isuru Amantha
 * Date: 10/17/2017
 * Time: 10:09 PM
 */
class UserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->library('session');
    }


    public function index()
    {
        $this->load->view("pages/login");
    }

    /*
     * Register the user in the database
     */
    public function register_user()
    {
        $userData = array(
            'userName' => $this->input->post('userName'),
            'userEmail' => $this->input->post('userEmail'),
            'userPassword' => md5($this->input->post('userPassword')),
        );

        $isValidEmail = $this->user_model->email_check($userData['userEmail']);

        if ($isValidEmail) {
            $this->user_model->register_user($userData);
            $this->session->set_flashdata('success_msg', 'Successfully Registered! Please login now');
            redirect('user/login_view');
        } else {
            $this->session->set_flashdata('error_msg', 'Some error occurred! Try again please.');
            redirect('user/register.php');
        }
    }


    public function login_view()
    {
        $this->load->view("pages/login.php");
    }

    public function register_view()
    {
        $this->load->view("pages/register.php");
    }

    /*
     * To complete the login
     */
    function login_user()
    {
        $userLoginData = array(
            'userName' => $this->input->post('userName'),
            'userPassword' => md5($this->input->post('userPassword'))
        );

        $data = $this->user_model->login_user($userLoginData['userName'], $userLoginData['userPassword']);
        if ($data) {
            $this->session->set_userdata('userId', $data['userId']);
            $this->session->set_userdata('userName', $data['userName']);
            $this->session->set_userdata('userEmail', $data['userEmail']);

            redirect('/DashboardController/getCelebrityDetails');
        } else {
            $this->session->set_flashdata('error_msg', 'Some error occurred! Try again please.');
            $this->load->view("pages/login.php");
        }
    }


    function user_profile()
    {
        $this->load->view('pages/user_profile.php');
    }

    /*
     * To logout from the session
     */
    public function user_logout()
    {
        $this->session->sess_destroy();
        redirect('userController/login_view', 'refresh');
    }


}