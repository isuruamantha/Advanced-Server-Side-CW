<?php

/**
 * Created by PhpStorm.
 * UserController: Isuru Amantha
 * Date: 11/30/2017
 * Time: 11:41 AM
 */
class ListModel extends CI_model
{

    /*
     * create the list
     */
    public function createList($user)
    {
        $this->db->insert('lists', $user);
    }

    /*
     * Update an item
     */
    public function updateList($list)
    {
        $this->db->where('listId', $list['listId']);
        $this->db->update('lists', $list);
    }

    /*
    * Delete list
    */
    public function deleteList($listId)
    {
        $this->db->where('listId', $listId);
        if ($this->db->delete('lists')) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Get all lists according the user id
     */
    public function getLists($userId)
    {
        $this->db->select('*');
        $this->db->from('lists');
        $this->db->where('userId', $userId);

        if ($query = $this->db->get()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /*
     * Get all lists
     */
    public function getAllLists()
    {
        $this->db->select('*');
        $this->db->from('lists');

        if ($query = $this->db->get()) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}


?>