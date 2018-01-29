<?php

/**
 * Created by PhpStorm.
 * UserController: Isuru Amantha
 * Date: 11/30/2017
 * Time: 11:41 AM
 */
class ItemModel extends CI_model
{

    /*
     * create the list
     */
    public function createItem($item)
    {
        $this->db->insert('items', $item);
    }

    /*
     * Update an item
     */
    public function updateItem($item)
    {
        $this->db->where('itemId', $item['itemId']);
        $this->db->update('items', $item);
    }


    /*
    * Delete an item
    */
    public function deleteItem($item)
    {
        $this->db->where('itemId', $item);
        if ($this->db->delete('items')) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Get all items according to the list
     */
    public function getItems($lisId)
    {
        $this->db->select('*');
        $this->db->from('items');
        $this->db->where('listId', $lisId);
        $this->db->order_by("deadline", "asc");
        $this->db->order_by("priority", "desc");

        if ($query = $this->db->get()) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}


?>