<?php
//if (!defined('BASEPATH'))
//    exit('No direct script access allowed');

class Ajax_ctrl extends CI_Controller {

        function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
    }

// This function call from AJAX
    public function delete_row() {
        $id = $this->input->post('id');
        $data = array('status' => '0');
        echo $this->Task_model->status_update($data, $id);
    }
    public function mark_complete()
    {
        $id = $this->input->post('id');
        $data = array('task_status' => '1');
        echo $this->Task_model->status_update($data, $id);
    }
}
