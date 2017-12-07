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
        $this->load->library(array('session', 'form_validation'));
        $this->load->library('form_validation');
    }


    public function index()
    {
        $this->load->view("templates/header");
        $this->load->view("pages/login");
        $this->load->view("templates/footer");
    }

    /*
     * Register the user in the database
     */
    public function register_user()
    {

        $this->form_validation->set_rules('userName', 'Username', 'required|min_length[5]');
        $this->form_validation->set_rules('userEmail', 'Email', 'required');
        $this->form_validation->set_rules('userPassword', 'Password', 'required');
        $this->form_validation->set_rules('userPasswordConfirm', 'Password Confirmation', 'required|matches[userPassword]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("templates/header");
            $this->load->view("pages/register.php");
            $this->load->view("templates/footer");
        } else {
            $userData = array(
                'userName' => $this->input->post('userName'),
                'userEmail' => $this->input->post('userEmail'),
                'userPassword' => md5($this->input->post('userPassword')),
            );

            $isValidEmail = $this->user_model->email_check($userData['userEmail']);

            if ($isValidEmail) {
                $this->user_model->register_user($userData);
                $this->session->set_flashdata('success_msg', 'Successfully Registered! Please login now');
                redirect('userController/login_view');
            } else {
                $this->session->set_flashdata('error_msg', 'Some error occurred! Try again please.');
                redirect('userController/register_view.php');
            }
        }
    }

/*
 * To Load the login view
 */
    public function login_view()
    {
        $this->load->view("templates/header");
        $this->load->view("pages/login.php");
        $this->load->view("templates/footer");
    }

    /*
     * To Load the register view
     */
    public function register_view()
    {
        $this->load->view("templates/header");
        $this->load->view("pages/register.php");
        $this->load->view("templates/footer");
    }

    /*
     * To complete the login
     */
    function login_user()
    {

        $this->form_validation->set_rules('userName', 'Username', 'required');
        $this->form_validation->set_rules('userPassword', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("templates/header");
            $this->load->view("pages/login.php");
            $this->load->view("templates/footer");

        } else {
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
                $this->session->set_flashdata('error_msg', 'Invalid Credentials! Try again please.');

                $this->load->view("templates/header");
                $this->load->view("pages/login.php");
                $this->load->view("templates/footer");
            }
        }
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