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

    /*
 * Retreive total count of users
 */
    public function getTotalUsercount()
    {
        $this->db->select('userId');
        $this->db->from('user');

        if ($query = $this->db->get()) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    /*
* Retreive the history of the user
*/
    public function getUserHistory($userId)
    {
        $this->db->select('*');
        $this->db->from('votes');

        $this->db->join('user', 'user.userId = votes.userId', 'left');
        $this->db->join('celebritydetails', 'celebritydetails.id = votes.celebrityId', 'left');
        $this->db->where('votes.userId', $userId);

        if ($query = $this->db->get()) {
            return ($query->result_array());
        } else {
            return false;
        }
    }

}


?>