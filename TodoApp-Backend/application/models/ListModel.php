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
        $this->db->insert('listsdetails', $user);
    }

    /*
     * Update an item
     */
    public function updateList($list)
    {
        $this->db->where('listId', $list['listId']);
        $this->db->update('listsdetails', $list);
    }

    /*
    * Delete list
    */
    public function deleteList($list)
    {
    }


}


?>