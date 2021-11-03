<?php
	class Users_model extends CI_Model{
		public function get_user_list(){
			$query = $this->db->get('user');
        	return $query->result();
		}

		public function get_user_details($id){
			$query = $this->db->get_where("user", array("id" => $id));
			return $query->row_array();
		}

		public function delete_user($id){
			$this->db->trans_start();
	        $this->db->where('id',$id);
	        $this->db->delete('user');
	        $this->db->trans_complete();
	        if($this->db->trans_status() === TRUE){
	            return "success";
	        }
	        else{
	            return "error";
	        }
		}

		public function create_user($data){
			$insert = $this->db->insert('user',$data);
	        $insert_id = $this->db->insert_id();
	        return $insert_id;
		}

		public function update_user($data, $id){
			$this->db->trans_start();
	        $this->db->where('id',$id);
	        $this->db->update('user',$data);
	        $this->db->trans_complete();
	        if($this->db->trans_status() === TRUE){
	            return "success";
	        }
	        else{
	            return "error";
	        }
		}
	}

?>