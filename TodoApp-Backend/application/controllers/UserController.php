<?php

/**
 * Created by PhpStorm.
 * UserController: Isuru Amantha
 * Date: 10/17/2017
 * Time: 10:09 PM
 */
class UserController extends CI_Controller
{


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
     * To logout from the session
     */
    public function user_logout()
    {
        $this->session->sess_destroy();
        redirect('userController/login_view', 'refresh');
    }


}