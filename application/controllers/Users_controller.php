<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_controller extends CI_Controller {
	function __construct(){
		parent::__construct();

        $this->load->model("users_model", 'users_model');
    }

	public function index(){
		$this->data['pageTitle'] = 'Users';

        $this->load->view('layouts/header', $this->data);
        $this->load->view('users/users');
        $this->load->view('layouts/footer');
	}

	public function getUserList(){
		$user_list = $this->users_model->get_user_list();

		$this->data['status'] = "success";
		$this->data['user_list'] = $user_list;

		echo json_encode($this->data);
	}

	public function deleteUser(){
		$id = $this->input->post("id");

		$user_details = $this->users_model->get_user_details($id);

		if(!empty($user_details)){
			$delete = $this->users_model->delete_user($id);

			if($delete == "success"){
				$name = $user_details['first_name']." ".$user_details['last_name'];

				$this->data['msg'] = "<strong>".strtoupper($name)."</strong> was successfully deleted.";
				$this->data['status'] = "success";
			}
			else{
				$this->data['status'] = "error";
				$this->data['msg'] = "Unable to delete user. Please contact your administrator.";
			}
			
		}
		else{
			$this->data['status'] = "error";
			$this->data['msg'] = "Unable to delete user. Please contact your administrator.";
		}

		echo json_encode($this->data);
	}

	public function addUser(){
		$first_name = $this->input->post("first_name");
		$last_name = $this->input->post("last_name");
		$position = $this->input->post("position");

		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('last_name', 'last name', 'required');
		$this->form_validation->set_rules('position', 'position', 'required');

		if($this->form_validation->run() == FALSE){
            $this->data['status'] = "error";
            $this->data['msg'] = validation_errors();
        }
        else{
        	date_default_timezone_set("Asia/Manila");
        	$create_date = date("Y-m-d H:i:s");
        	$data = array(
        		"first_name" => $first_name,
        		"last_name" => $last_name,
        		"position" => $position,
        		"create_date" => $create_date
        	);

        	$insert = $this->users_model->create_user($data);

        	$user_details = array(
        		"first_name" => $first_name,
        		"last_name" => $last_name,
        		"position" => $position,
        		"create_date" => $create_date,
        		"id" => $insert
        	);

        	$this->data['user_details'] = $user_details;
        	$this->data['status'] = "success";
        	$this->data['msg'] = "Successfully added new user.";

        }

        echo json_encode($this->data);
	}

	public function updateUser(){
		$first_name = $this->input->post("first_name");
		$last_name = $this->input->post("last_name");
		$position = $this->input->post("position");
		$id = $this->input->post("id");

		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('last_name', 'last name', 'required');
		$this->form_validation->set_rules('position', 'position', 'required');

		if($this->form_validation->run() == FALSE){
            $this->data['status'] = "error";
            $this->data['msg'] = validation_errors();
        }
        else{
        	$data = array(
        		"first_name" => $first_name,
        		"last_name" => $last_name,
        		"position" => $position
        	);

        	$update = $this->users_model->update_user($data, $id);

        	$this->data['user_details'] = $data;
        	$this->data['status'] = "success";
        	$this->data['msg'] = "Successfully update user.";
        }

        echo json_encode($this->data);
	}
}