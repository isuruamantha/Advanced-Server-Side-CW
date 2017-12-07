<?php

/**
 * Created by PhpStorm.
 * UserController: Isuru Amantha
 * Date: 11/30/2017
 * Time: 11:41 AM
 */
class Celebrity_model extends CI_model
{

    /*
     * Insert the celebrity details into the database
     */
    public function register_celebrity($celebrity)
    {
        $this->db->insert('celebritydetails', $celebrity);

    }

    /*
     * Retreive all the celebrity details from the database
     */
    public function getCelebrityDetails()
    {
        $id = $this->session->userdata('userId');
        $this->db->select('*');
        $this->db->from('celebritydetails');
        $this->db->where('`id` NOT IN (SELECT `celebrityId` FROM `votes` WHERE `userId` = ' . $id . ')');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(2);

        if ($query = $this->db->get()) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    /*
     * Insert the vote details
     */
    public function addVote($vote)
    {
        $this->db->insert('votes', $vote);
        $this->db->select('voteCount');
        $this->db->from('celebritydetails');
        $this->db->where('id', $vote['celebrityId']);
        if ($query = $this->db->get()) {
            $totalVoteCount = ($query->result_array());

            $totalVoteCount = ($totalVoteCount[0]['voteCount']);
            $totalVoteCount += 1;

            $data = array(
                'voteCount' => $totalVoteCount
            );
            $this->db->where('id', $vote['celebrityId']);
            $this->db->update('celebritydetails', $data);

            return $query->result_array();
        } else {
            return false;
        }

    }

    /*
     * Receive celebrity details in decending order
     */
    public function getCelebrityDetailsDecs()
    {
        $this->db->select('*');
        $this->db->from('celebritydetails');
        $this->db->order_by('voteCount', 'DESC');

        if ($query = $this->db->get()) {
            return $query->result_array();

        } else {
            return false;
        }
    }

    /*
     * Retreive total count of votes
     */
    public function getTotalCountofVotes()
    {
        $this->db->select_sum('voteCount');
        $this->db->from('celebritydetails');

        if ($query = $this->db->get()) {
            return $query->row()->voteCount;
        } else {
            return false;
        }
    }

    /*
* Retreive total count of celebrities
*/
    public function getTotalCelebrityCount()
    {
        $this->db->select('id');
        $this->db->from('celebritydetails');

        if ($query = $this->db->get()) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

}

?>