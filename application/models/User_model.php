
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "pf_user"; 

    public $user_id;
    public $password; 
    public $name; 
    public $email; 
    public $phone;  
    public $hash; 

    public function rules()
    {
        return [];
    }

    public function countRow(){
        $query = $this->db->query('
            SELECT * FROM pf_users 
        '); 
        return $query->num_rows();
    }

    public function getAll()
    { 
        $this->db->select('pf_users.*'); 
        $this->db->from('pf_users'); 
        $query = $this->db->get();
        return $query->result();

    }
}