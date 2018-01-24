<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

/**
 * Created by PhpStorm.
 * User: Isuru Amantha
 * Date: 1/2/2018
 * Time: 4:39 PM
 */
class Lists extends REST_Controller
{

    /*
 * Get lists all lists
 */
    public function index_get($userId)
    {
        if (!$userId) {
            $result = $this->ListModel->getAllLists();
            $this->response($result, 200);
        } else {
            $result = $this->ListModel->getLists($userId);
            if ($result === false) {
                $this->response("Error", 200);
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
        $listName = $this->post('listName');
        $userId = $this->post('userId');
        $itemCount = 0;

        if (!$listName) {
            $this->response("Please fill the relevant data", 400);
        } else {
            $result = $this->ListModel->createList(array("listName" => $listName, "itemCount" => $itemCount,
                "userId" => $userId));
            if ($result === 0) {
                $this->response("Error", 404);
            } else {
                $this->response("Success", 200);
            }
        }
    }

    /*
 * Update a list
 */
    public function index_put()
    {
        $listId = $this->put('listId');
        $listName = $this->put('listName');

        if (!$listName || !$listId) {
            $this->response("Please fill the relevant data", 400);
        } else {
            $result = $this->ListModel->updateList(array("listId" => $listId, "listName" => $listName));
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
    public function index_delete($id = 0)
    {
        if ($this->ListModel->deleteList($id)) {
            $this->response("Success", 200);
        }

    }
}