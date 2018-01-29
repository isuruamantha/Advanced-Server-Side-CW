<?php

/**
 * Created by PhpStorm.
 * UserController: Isuru Amantha
 * Date: 11/30/2017
 * Time: 11:41 AM
 */
class UserModel extends CI_model
{

    /*
     * Insert the user details into the table
     */
    public function registerUser($user)
    {
        $this->db->insert('users', $user);
    }

    /*
     * Validate the login details
     */
    public function loginUser($userName, $password)
    {
        $this->db->select('*');
        $this->db->from('users');
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
    public function emailCheck($email)
    {
        $this->db->select('*');
        $this->db->from('users');
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