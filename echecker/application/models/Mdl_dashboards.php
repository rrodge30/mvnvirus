
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_dashboards extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getMessage(){
        $query=$this->db->limit(1)->get('bulletintbl');
        return $query->result_array();
    }

    public function postMessage($data=array()){
        $key = key($data);
        $query = $this->db->where('id','1')->get('bulletintbl');
        if($isMessageExist = $query->row_array()){
            $isQueryUpdated = $this->db->set('message',$data[$key])->where('id',1)->update('bulletintbl');
            return $isQueryUpdated;
        }else{
            $isQueryInserted = $this->db->insert('bulletintbl',array('message'=>$data[$key]));
            return$isQueryInserted;
        }
        
    
    }
}


?>