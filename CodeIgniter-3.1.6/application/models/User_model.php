<?php

/**
 * Created by PhpStorm.
 * UserController: Isuru Amantha
 * Date: 11/30/2017
 * Time: 11:41 AM
 */
class User_model extends CI_model
{

    /*
     * Insert the user details into the database
     */
    public function register_user($user)
    {
        $this->db->insert('user', $user);
    }

    /*
     * Validate the login details
     */
    public function login_user($userName, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('userName', $userName);
        $this->db->where('userPassword', $password);

        if ($query = $this->db->get()) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /*
     * To check whether the email is in the database or not
     */
    public function email_check($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('userEmail', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

}


?>