<?php
class Task_ctrl extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
    }
            
    function index()
    {
        #Including Validation Library..
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        #Validating Task Name Field..
        $this->form_validation->set_rules('tname', 'Task Name', 'required');
        #Validating DropDown Field..
        $this->form_validation->set_rules('prior', 'Prior', 'required|alpha_numeric');
        $this->form_validation->set_message('alpha_numeric','Select your Priority!');
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('header');
            $this->load->view('task_view');
            $this->load->view('footer');
        }
        else
        {
            $data = array(
                'task_name' => $this->input->post('tname'),
                'prior' => $this->input->post('prior'),
                'status' => '1',
            );
        #setting values to DB tables..
        $this->Task_model->form_insert($data);
        
        #Loding View..
        $this->load->view('header');
        $this->load->view('Task_view');
        $this->load->view('footer');
        }
    }
    
    function edit($id=0)
    {
        #Including Validation Library..
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        #Validating Task Name Field..
        $this->form_validation->set_rules('tname', 'Task Name', 'required');
        #Validating DropDown Field..
        $this->form_validation->set_rules('prior', 'Prior', 'required|alpha_numeric');
        $this->form_validation->set_message('alpha_numeric','Select your Priority!');
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('header');
            $data['result'] = $this->Task_model->get_atask($id);
            $this->load->view('edit_task',$data);
            $this->load->view('footer');
        }
        else
        {
            $id = $this->input->post('tid');
            $data = array(
                'task_name' => $this->input->post('tname'),
                'prior' => $this->input->post('prior'),
            );
        #setting values to DB tables..
        $this->Task_model->form_update($data,$id);
        
        #Loding View..
        $this->list_task();
        }
    }
    
    function list_task()
    {
        $data['result'] = $this->Task_model->get_tasks();
        $this->load->view('header');
        $this->load->view('list_task',$data);
        $this->load->view('footer');
    }
    function list_completed()
    {
        $data['result'] = $this->Task_model->get_where_tasks('completed');
        $this->load->view('header');
        $this->load->view('list_task',$data);
        $this->load->view('footer');
    }
    function list_deleted()
    {
        $data['result'] = $this->Task_model->get_where_tasks('deleted');
        $this->load->view('header');
        $this->load->view('list_task',$data);
        $this->load->view('footer');
    }
}