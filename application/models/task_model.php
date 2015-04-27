<?php
class Task_model extends CI_Model {
    function Task_model()
    {
        parent:: __construct();
    }
    
    function form_insert($data)
    {
        $this->db->insert('task',$data);
    }
    
    function form_update($data,$id)
    {
        $this->db->update('task',$data,"task_id=$id");
    }
    
    function status_update($data, $id)
    {
        return $this->db->update('task',$data,"task_id=$id");
    }
    function get_tasks()
    {
        $query = $this->db->get('task');
        if($query->num_rows() > 0)
        {
            $this->db->select('*');
            $this->db->from('task');
            $this->db->join('priority', 'task.prior = priority.id');
//            $this->db->where('table1.col1', 2);

            $query = $this->db->get();
            return $query->result();
        }
        else
        {
            show_error('DB is empty!');
        }
    }
    
    function get_where_tasks($opt)
    {
        $query = $this->db->get('task');
        if($query->num_rows() > 0)
        {
            $this->db->select('*');
            $this->db->from('task');
            $this->db->join('priority', 'task.prior = priority.id');
            if($opt == 'completed')
                $this->db->where('task.task_status', 1);
            elseif ($opt == 'deleted') {
                $this->db->where('task.status', 0);
            }

            $query = $this->db->get();
            return $query->result();
        }
        else
        {
            show_error('DB is empty!');
        }
    }
    
    function get_atask($id)
    {
        return $this->db->get_where('task', array('task_id' => $id))->row();
    }
    
}