<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('post_job_model');
	}

	function employees_list($id) {
		$data['getcategory']=$this->Crud_model->GetData('category');
		$data['get_banner']=$this->Crud_model->get_single('banner',"id='2'");
		$this->load->view('header');
		$this->load->view('frontend/new_employees_list',$data);
		$this->load->view('footer');
	}

	function searchjob() {
		$search_title = $this->input->post('search_title');
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		if(!empty($search_title) || !empty($country) || !empty($state) || !empty($city)) {
			$data['countries']=$this->Crud_model->GetData('countries',"","");
			$data['states']= '';
			$data['cities']= '';
		} else {
			$data['countries']=$this->Crud_model->GetData('countries',"","");
			$data['states']= '';
			$data['cities']= '';
		}
		$data['getcategory']=$this->Crud_model->GetData('category');
		$data['get_banner']=$this->Crud_model->get_single('banner',"id='2'");
		$data1['title'] = "Search Result";
		$this->load->view('header', $data1);
		$this->load->view('frontend/new_employees_list',$data);
		$this->load->view('footer');
	}

	function fetch_data() {
		sleep(1);
		$category_id = $this->input->post('category_id');
		$title = $this->input->post('title_keyword');
		$post_id = $this->input->post('post_id');
		$days = $this->input->post('days');
		$subcategory_id = $this->input->post('subcategory_id');
		$duration = $this->input->post('duration');
		$pay_type = $this->input->post('pay_type');
		$charges = $this->input->post('charges');
		$location = $this->input->post('location');
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$search_title = $this->input->post('search_title');
		$search_location = $this->input->post('search_location');
		if(isset($category_id) && !empty($category_id) || isset($title) && !empty($title) || isset($days) && !empty($days)||isset($subcategory_id) && !empty($subcategory_id)|| isset($duration) && !empty($duration) || isset($pay_type) && !empty($pay_type) || isset($charges) && !empty($charges)|| isset($location) && !empty($location) || isset($search_title) && !empty($search_title) || isset($search_location) && !empty($search_location) || isset($country) && !empty($country) || isset($state) && !empty($state) || isset($city) && !empty($city)) {
			$total_count=$this->post_job_model->subcategory_getcount($title, $location,$days,$category_id,$subcategory_id,$duration,$pay_type,$charges,$search_title,$search_location,$country,$state,$city);
		} else {
			$get_product=$this->Crud_model->GetData('postjob','',"subcategory_id='".$post_id."' and is_delete='0' AND status = 'Active'");
			$total_count=count($get_product);
		}

		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $total_count;
		$config['per_page'] =10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'><a href='#'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		if (!empty($page)){
			$start = ($page - 1) * $config['per_page'];
		} else {
			$start = '0';
		}

		if(isset($category_id) || isset($title)|| isset($days)||isset($subcategory_id)||isset($duration)||isset($pay_type)||isset($charges)|| isset($location)|| isset($search_title)|| isset($search_location)|| isset($country)|| isset($state)|| isset($city)) {
			$getdata=$this->post_job_model->subcategory_fetchdata($config["per_page"], $start, $title, $location,$days,$category_id,$subcategory_id,$duration,$pay_type,$charges,$post_id,$search_title,$search_location,$country,$state,$city);
		} else {
			$getdata=$this->post_job_model->subcategory_fetchdata($config["per_page"], $start, $title, $location,$days,$category_id,$subcategory_id,$duration,$pay_type,$charges,$post_id,$search_title,$search_location,$country,$state,$city);
		}

		$output = array(
			'pagination_link'  => $this->pagination->create_links(),
			'postlist' =>$getdata,
			'keyword' =>$this->input->post('search_title'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'keyword_location' =>$this->input->post('search_location'),
		);
		echo json_encode($output);
	}

	function employer_detail($user_id) {
		$userid=base64_decode($user_id);
		$data['userdata']=$this->Crud_model->get_single('users',"userId='".$userid."'");
		$data['get_post']=$this->Crud_model->GetData('postjob','',"user_id='".$userid."' AND is_delete = '0'");
		$data['prod_list']=$this->db->query("SELECT user_product.id, user_product.prod_name, user_product.prod_description, user_product_image.prod_image FROM user_product_image JOIN user_product ON user_product.id = user_product_image.prod_id WHERE user_product.status = 1 AND user_product.is_delete = 1 AND user_id='".$userid."' group by user_product.id")->result_array();
		$data['get_banner']=$this->Crud_model->get_single('banner',"id='15'");
		$viewcount=$data['userdata']->view_count+1;
		$insert_data=array(
			'view_count'=>$viewcount,
		);
		$this->Crud_model->SaveData('users',$insert_data,"userId='".$userid."'");
		$data['title'] = 'Business Details';
		$this->load->view('header',$data);
		$this->load->view('frontend/employer_detail',$data);
		$this->load->view('footer');
	}

	function product_detail($id) {
		$prod_id = base64_decode($id);
		$data['prod_details']=$this->db->query("SELECT * FROM user_product WHERE status = 1 AND is_delete = 1 AND id='".$prod_id."'")->result_array();
		$data['title'] = 'Product Details';
		$this->load->view('header', $data);
		$this->load->view('frontend/product_detail', $data);
		$this->load->view('footer');
	}

	function workers_list() {
		$this->load->view('header');
		$this->load->view('frontend/workers_list');
		$this->load->view('footer');
	}

	function getVisIpAddr() {
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        	return $_SERVER['HTTP_CLIENT_IP'];
    	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	return $_SERVER['HTTP_X_FORWARDED_FOR'];
    	} else {
        	return $_SERVER['REMOTE_ADDR'];
    	}
	}

	function post_job() {
		$vis_ip = $this->getVisIPAddr(); // Store the IP address
		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));
		$data['countryName'] = $ipdat->geoplugin_countryName;
		$data['countries']=$this->Crud_model->GetData('countries',"","");
		$data['category']=$this->Crud_model->GetData('category','','');
		$data['subcategory']=$this->Crud_model->GetData('sub_category','','');
		$data['get_banner']=$this->Crud_model->get_single('banner',"page_name='Post Jobs'");
		$data['title'] = 'Post Work';
		$this->load->view('header', $data);
		$this->load->view('frontend/post_job',$data);
		$this->load->view('footer');
	}

	public function update_post_job($id) {
		$work_id = base64_decode($id);
		$update_data = $this->Crud_model->get_single('postjob', "id='" . $work_id . "'");
		$data = array(
			'button' => 'update',
			'action' => base_url('welcome/edit_post_job'),
			'post_title' => $update_data->post_title,
			'description' => $update_data->description,
			'key_skills' => $update_data->required_key_skills,
			'duration' => $update_data->duration,
			'duration' => $update_data->duration,
			'pay_type' => $update_data->pay_type,
			'charges' => $update_data->charges,
			'currency' => $update_data->currency,
			'category' => $update_data->category_id,
			'subcategory' => $update_data->subcategory_id,
			'appli_deadeline' => $update_data->appli_deadeline,
			'countries' => $update_data->country,
			'state' => $update_data->state,
			'cities' => $update_data->city,
			'location' => $update_data->location,
			'latitude' => $update_data->latitude,
			'longitude' => $update_data->longitude,
			'id' => $work_id,
		);
		$data['title'] = 'Update Posted Work';
		$this->load->view('header', $data);
		$this->load->view('frontend/post_job', $data);
		$this->load->view('footer');
	}


	public function edit_post_job() {
		$key_skills = $this->input->post('key_skills');
		for ($i=0; $i < count($key_skills); $i++) {
			$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '".$key_skills[$i]."'")->result();
			if(empty($get_specialist)) {
				$insrt = array(
					'specialist_name'=>ucfirst($key_skills[$i]),
					'created_date'=>date('Y-m-d H:i:s'),
				);
				$this->db->insert('specialist',$insrt);
			}
		}
		$id = $_POST['id'];
		$data=array(
			'required_key_skills'=>implode(", ",$this->input->post('key_skills',TRUE)),
			'category_id'=>$this->input->post('category_id',TRUE),
			'subcategory_id'=>$this->input->post('subcategory_id',TRUE),
			'post_title'=>$this->input->post('post_title',TRUE),
			'description'=>$this->input->post('description',TRUE),
			'duration'=>$this->input->post('duration',TRUE),
			'pay_type'=>$this->input->post('pay_type',TRUE),
			'charges'=>$this->input->post('charges',TRUE),
			'currency'=>$this->input->post('currency',TRUE),
			'location'=>$this->input->post('location',TRUE),
			'latitude'=>$this->input->post('latitude',TRUE),
			'longitude'=>$this->input->post('longitude',TRUE),
			'country'=>$this->input->post('country-dropdown',TRUE),
			'state'=>$this->input->post('state-dropdown',TRUE),
			'city'=>$this->input->post('city-dropdown',TRUE),
			'appli_deadeline'=>$this->input->post('appli_deadeline',TRUE),
			'created_date'=>date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('postjob', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Post Job Updated Successfully !');
		redirect(base_url('myjob'));
	}

	public function get_subcategory() {
		$id =$_POST['id'];
		$CategoryData = $this->Crud_model->GetData('sub_category',"","category_id ='".$id."'");
		$html = "<option value=''>Select Sub Category</option>";
		foreach ($CategoryData as $row_data) {
			$html .= "<option value='".$row_data->id."'>".ucfirst($row_data->sub_category_name)."</option>";
		}
		echo $html;
	}

	public function save_postjob() {
		if(!empty($this->input->post('key_skills'))) {
			@$key_skills = @$this->input->post('key_skills');
			for ($i=0; $i < count(@$key_skills); $i++) {
				$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '".@$key_skills[$i]."'")->result();
				if(empty($get_specialist)) {
					$insrt = array(
						'specialist_name'=>ucfirst($key_skills[$i]),
						'created_date'=>date('Y-m-d H:i:s'),
					);
					$this->db->insert('specialist',$insrt);
				}
			}
			$data=array(
				'user_id'=>$_SESSION['afrebay']['userId'],
				'required_key_skills'=>implode(", ",@$this->input->post('key_skills',TRUE)),
				'category_id'=>$this->input->post('category_id',TRUE),
				'subcategory_id'=>$this->input->post('subcategory_id',TRUE),
				'post_title'=>$this->input->post('post_title',TRUE),
				'description'=>$this->input->post('description',TRUE),
				'duration'=>$this->input->post('duration',TRUE),
				'pay_type'=>$this->input->post('pay_type',TRUE),
				'charges'=>$this->input->post('charges',TRUE),
				'currency'=>$this->input->post('currency',TRUE),
				'location'=>@$this->input->post('location',TRUE),
				'latitude'=>@$this->input->post('latitude',TRUE),
				'longitude'=>@$this->input->post('longitude',TRUE),
				'country'=>$this->input->post('country-dropdown',TRUE),
				'state'=>$this->input->post('state-dropdown',TRUE),
				'city'=>$this->input->post('city-dropdown',TRUE),
				'appli_deadeline'=>$this->input->post('appli_deadeline',TRUE),
				'created_date'=>date('Y-m-d H:i:s'),
			);
		} else {
			$data=array(
				'user_id'=>$_SESSION['afrebay']['userId'],
				'required_key_skills'=>'',
				'category_id'=>$this->input->post('category_id',TRUE),
				'subcategory_id'=>$this->input->post('subcategory_id',TRUE),
				'post_title'=>$this->input->post('post_title',TRUE),
				'description'=>$this->input->post('description',TRUE),
				'duration'=>$this->input->post('duration',TRUE),
				'pay_type'=>$this->input->post('pay_type',TRUE),
				'charges'=>$this->input->post('charges',TRUE),
				'currency'=>$this->input->post('currency',TRUE),
				'location'=>@$this->input->post('location',TRUE),
				'latitude'=>@$this->input->post('latitude',TRUE),
				'longitude'=>@$this->input->post('longitude',TRUE),
				'country'=>$this->input->post('country-dropdown',TRUE),
				'state'=>$this->input->post('state-dropdown',TRUE),
				'city'=>$this->input->post('city-dropdown',TRUE),
				'appli_deadeline'=>$this->input->post('appli_deadeline',TRUE),
				'created_date'=>date('Y-m-d H:i:s'),
			);
		}
		
		
		$this->Crud_model->SaveData('postjob',$data);
		$this->session->set_flashdata('message', 'Post Job Created Successfull !');
		$insert_id = $this->db->insert_id();
		$sitemap_date = array(
			'link'=>'/'.'workdetail/'.base64_encode($insert_id),
			'changefreq' => 'daily',
			'priority' => '0.51',
			'lastmod'=> date('c', time()),
		);
		$this->Crud_model->SaveData('sitemap',$sitemap_date);
		redirect(base_url("workdetail/".base64_encode($insert_id)));
	}

	function post_jobinfo($id) {
		$post_id=base64_decode($id);
		$con="postjob.id='".$post_id."' and postjob.is_delete='0' AND postjob.status = 'Active'";
		$data['get_postjob']=$this->post_job_model->viewdata($con);
		$this->load->view('header');
		$this->load->view('user_dashboard/jobinfo',$data);
		$this->load->view('footer');
	}
	
	public function subcategory_data() {
		$id =$_POST['id'];
		$CategoryData = $this->Crud_model->GetData('sub_category',"","category_id ='".$id."'");
		$html = "";
		if(!empty($CategoryData)) {
			$html = "<option value=''>Select Sub Category</option>";
			foreach ($CategoryData as $row_data) {
				$html .= "<option value='".$row_data->id."'>".ucfirst($row_data->sub_category_name)."</option>";
			}
		} else {
			$html = '';
		}
		echo $html;
	}

	public function filter_job() {
		$con="postjob.is_delete='0' AND postjob.status = 'Active'";
		if(isset($_POST['title_keyword'])&& !empty($_POST['title_keyword'])) {
			$con .=" and postjob.post_title like '%".$_POST['title_keyword']."%'";
		}

		if(isset($_POST['search_location'])&& !empty($_POST['search_location'])) {
			$con.=" and postjob.location like '%".$_POST['search_location']."%'";
		}

		if(isset($_POST['category_id'])&& !empty($_POST['category_id'])) {
			$con.=" and postjob.category_id='".$_POST['category_id']."'";
		}

		if(isset($_POST['days'])&& !empty($_POST['days'])) {
			if($_POST['days']=='one') {
				$con ="postjob.created_date>=NOW()-INTERVAL 1 HOUR";
			} else {
				$current_date=date('Y-m-d');
				$dates=date('Y-m-d', strtotime($current_date.'-'.$_POST['days'].'days'));
				$con ="postjob.created_date>='".$dates."'";
			}
		}

		if(isset($_POST['subcategory_id'])&& !empty($_POST['subcategory_id'])) {
			$con.=" and (";
			foreach ($_POST['subcategory_id'] as $key => $value) {
				if($key==0) {
					$con.="  postjob.subcategory_id ='".$value."'";
				} else {
					$con.="or  postjob.subcategory_id ='".$value."'";
				}
			}
			$con.=")";
		}
		$data['get_postjob']=$this->post_job_model->postjobdata($con);
		$this->load->view('filter/postjob_filter',$data);
	}

	public function states_by_country() {
		$c_name = $this->input->post('country_name');
		$get_cid = $this->db->query("SELECT * FROM countries WHERE name = '".$c_name."'")->result_array();
		$state_list = $this->db->query("SELECT * FROM states WHERE country_id = '".$get_cid[0]['id']."'")->result_array();
		if(!empty($state_list)) {
			$html = "<option value=''>Select State</option>";
			foreach ($state_list as $row_data) {
				$html .= "<option value='".$row_data['name']."'>".ucfirst($row_data['name'])."</option>";
			}
		} else {
			$html = '';
		}
		echo $html;
	}

	public function cities_by_state() {
		$s_name = $this->input->post('state_name');
		$get_sid = $this->db->query("SELECT * FROM states WHERE name = '".$s_name."'")->result_array();
		$cities_list = $this->db->query("SELECT * FROM cities WHERE state_id = '".$get_sid[0]['id']."'")->result_array();
		if(!empty($cities_list)) {
			$html = "<option value=''>Select City</option>";
			foreach ($cities_list as $row_data) {
				$html .= "<option value='".$row_data['name']."'>".ucfirst($row_data['name'])."</option>";
			}
		} else {
			$html = '';
		}
		echo $html;
	}
}
