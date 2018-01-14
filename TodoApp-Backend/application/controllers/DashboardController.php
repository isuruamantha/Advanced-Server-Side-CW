<?php

/**
 * Created by PhpStorm.
 * UserController: Isuru Amantha
 * Date: 10/17/2017
 * Time: 10:09 PM
 */
class DashboardController extends CI_Controller
{

    public function index()
    {
        $this->load->view("templates/header");
        $this->load->view("pages/dashboard.php");
        $this->load->view("templates/footer");
    }

    /*
     * Display item details
     */
    public function viewList()
    {
        $this->load->view("templates/header");
        $this->load->view("pages/Item.php");
        $this->load->view("templates/footer");
    }

    /*
     * Get the celebrity details from the database
     */
    public function getCelebrityDetailsinDesc()
    {
        $data['celebDetails'] = $this->celebrity_model->getCelebrityDetailsDecs();
        $data['totalCountOfVotes'] = $this->celebrity_model->getTotalCountofVotes();
        $data['totalCountOfUsers'] = $this->user_model->getTotalUsercount();
        $data['totalCountOfCelebrities'] = $this->celebrity_model->getTotalCelebrityCount();
        $this->load->view("templates/header");
        $this->load->view("pages/results.php", $data);
        $this->load->view("templates/footer");
    }

    /*
  * Get the celebrity details from the database
  */
    public function ViewaddCelebrity()
    {
        $this->load->view("templates/header");
        $this->load->view("pages/addCelebrity.php", array('error' => ' '));
        $this->load->view("templates/footer");
    }

    /*
     * To view the history page
     */
    public function viewHistory()
    {
        $user_id = $this->session->userdata('userId');
        $data['userHistory'] = $this->user_model->getUserHistory($user_id);
        $this->load->view("templates/header");
        $this->load->view("pages/history.php", $data);
        $this->load->view("templates/footer");
    }

    /*
     * To logout the user
     */
    public function user_logout()
    {
        $this->session->sess_destroy();
        redirect('user/login_view', 'refresh');
    }

    /*
     * Upload the images and other details about the celebrity
     */
    public function do_upload()
    {

        $this->form_validation->set_rules('celebName', 'Celebrity Name', 'required');
        $this->form_validation->set_rules('celebDescription', 'Description', 'required');
        if (empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', 'Document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("templates/header");
            $this->load->view("pages/addCelebrity.php", array('error' => ' '));
            $this->load->view("templates/footer");
        } else {
            $config = array(
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1800",
                'max_width' => "1800"
            );

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload()) {
                $data = array('upload_data' => $this->upload->data());
            } else {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                echo $_POST;
            }

            $filename = $_FILES['userfile']['name'];
            $celebrityData = array(
                'name' => $this->input->post('celebName'),
                'description' => $this->input->post('celebDescription'),
                'imagePath' => $filename,
                'addedDate' => date("Y/m/d")
            );
            $this->celebrity_model->register_celebrity($celebrityData);
            $data['isModelNeeded'] = true;

            $data['celebDetails'] = $this->celebrity_model->getCelebrityDetails();
            $this->load->view("templates/header");
            $this->load->view("pages/dashboard.php", $data);
            $this->load->view("templates/footer");
        }
    }

    /*
     * To vote for the user
     */
    public function vote()
    {
        $vote = array(
            'userId' => $this->input->post('userId'),
            'celebrityId' => $this->input->post('celebrityId'),
            'votedDate' => date("Y/m/d")
        );

        $isResultAdded = $this->celebrity_model->addVote($vote);
        if (!$isResultAdded) {

        } else {
            $this->load->view("templates/header");
            $this->load->view("pages/results.php");
            $this->load->view("templates/footer");
        }
    }

}