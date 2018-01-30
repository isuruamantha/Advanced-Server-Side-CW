<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

/**
 * Created by PhpStorm.
 * Users: Isuru Amantha
 * Date: 1/2/2018
 * Time: 4:39 PM
 */
class Items extends REST_Controller
{

    /*
     * Get item lists
     */
    public function index_get($listId)
    {

        if (!$listId) {
            $resposnse = array("message" => "Please fill the relevant data", "code" => "001");
            $this->response($resposnse, 400);
        } else {
            $result = $this->ItemModel->getItems($listId);
            if ($result === false) {
                $resposnse = array("message" => "Error", "code" => "001");
                $this->response($resposnse, 400);
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

        /*
         * Priority level
         * 1 - low
         * 2 - medium
         * 3 - high
         */

        $priority = strtolower($priority);
        if ($priority == "low") {
            $priority = 1;
        } else if ($priority == "medium") {
            $priority = 2;
        } else {
            $priority = 3;
        }

        if (!$itemName || !$itemDetails || !$priority || !$listId || !$deadline) {
            $resposnse = array("message" => "Error", "code" => "001");
            $this->response($resposnse, 400);
        } else {
            $result = $this->ItemModel->createItem(array("itemName" => $itemName, "itemDetails" => $itemDetails,
                "priority" => $priority, "listId" => $listId, "deadline" => $deadline));
            if ($result === 0) {
                $resposnse = array("message" => "Error", "code" => "001");
                $this->response($resposnse, 400);
            } else {
                $resposnse = array("message" => "Success", "code" => "001");
                $this->response($resposnse, 201);
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

        $priority == strtolower($priority);
        if ($priority == "low") {
            $priority = 1;
        } else if ($priority == "medium") {
            $priority = 2;
        } else {
            $priority = 3;
        }

        if (!$itemName || !$itemDetails || !$priority || !$listId || !$deadline || !$itemId) {
            $resposnse = array("message" => "Please fill the relevant data", "code" => "001");
            $this->response($resposnse, 400);
        } else {
            $result = $this->ItemModel->updateItem(array("itemName" => $itemName, "itemDetails" => $itemDetails,
                "priority" => $priority, "listId" => $listId, "deadline" => $deadline, "itemId" => $itemId));
            if ($result === 0) {
                $resposnse = array("message" => "Error", "code" => "001");
                $this->response($resposnse, 400);
            } else {
                $resposnse = array("message" => "Success", "code" => "001");
                $this->response($resposnse, 200);
            }
        }
    }

    /*
     * Delete an item
     */
    public function index_delete($id)
    {

        if (!$id) {
            $resposnse = array("message" => "Please fill the relevant data", "code" => "001");
            $this->response($resposnse, 400);
        }
        if ($this->ItemModel->deleteItem($id)) {
            $resposnse = array("message" => "Success", "code" => "001");
            $this->response($resposnse, 200);
        } else {
            $resposnse = array("message" => "Failed", "code" => "001");
            $this->response($resposnse, 400);
        }

    }
}