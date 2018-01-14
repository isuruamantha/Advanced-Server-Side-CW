<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/2/2018
 * Time: 4:39 PM
 */
class Item extends REST_Controller
{

    /*
     * Get item lists
     */
    public function index_get($listId)
    {

        if (!$listId) {
            $this->response("Please fill the relevant data", 400);
        } else {
            $result = $this->ItemModel->getItems($listId);
            if ($result === false) {
                $this->response("Error", 404);
            } else {
                $this->response($result, 200);
            }
        }
    }

    /*
     * Create a list
     */
    public function index_post()
    {
        $itemName = $this->post('itemName');
        $itemDetails = $this->post('itemDetails');
        $priority = $this->post('priority');
        $deadline = $this->post('deadline');
        $listId = $this->post('listId');


        if (!$itemName || !$itemDetails || !$priority || !$listId || !$deadline) {
            $this->response("Please fill the relevant data", 400);
        } else {
            $result = $this->ItemModel->createItem(array("itemName" => $itemName, "itemDetails" => $itemDetails,
                "priority" => $priority, "listId" => $listId, "deadline" => $deadline));
            if ($result === 0) {
                $this->response("Error", 404);
            } else {
                $this->response("Success", 200);
            }
        }
    }

    /*
     * Update the item list
     */
    public function index_put()
    {
        $itemId = $this->put('itemId');
        $itemName = $this->put('itemName');
        $itemDetails = $this->put('itemDetails');
        $priority = $this->put('priority');
        $deadline = $this->put('deadline');
        $listId = $this->put('listId');


        if (!$itemName || !$itemDetails || !$priority || !$listId || !$deadline || !$itemId) {
            $this->response("Please fill the relevant data", 400);
        } else {
            $result = $this->ItemModel->updateItem(array("itemName" => $itemName, "itemDetails" => $itemDetails,
                "priority" => $priority, "listId" => $listId, "deadline" => $deadline, "itemId" => $itemId));
            if ($result === 0) {
                $this->response("Error", 404);
            } else {
                $this->response("Success", 200);
            }
        }
    }

    /*
     * Delete an item
     */
    public function index_delete($id)
    {

        if (!$id) {
            $this->response("Please fill the relevant data", 400);
        }
        if ($this->ItemModel->deleteItem($id)) {
            $this->response("Success", 200);
        } else {
            $this->response("Failed", 404);
        }

    }
}