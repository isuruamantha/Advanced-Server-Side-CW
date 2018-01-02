<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/2/2018
 * Time: 4:39 PM
 */
class Lists extends REST_Controller
{

    /*
     * Create a list
     */
    public function create_post()
    {
        $listName = $this->post('listName');
        $itemCount = 0;

        if (!$listName) {
            $this->response("Please fill the relevant data", 400);
        } else {
            $result = $this->ListModel->createList(array("listName" => $listName, "itemCount" => $itemCount));
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
    public function update_put()
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
}