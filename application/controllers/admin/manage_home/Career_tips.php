<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Career_tips extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelHome/Career_tips_model');
	}
	function index()
	{

		$header = array('title' => 'career');
		$data = array(
			'heading' => 'List of career tips',
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/managehome/careertips_list',$data);
		$this->load->view('admin/footer');
	}

	public function ajax_manage_page()

	{
		$get_data = $this->Career_tips_model->get_datatables();
		if(empty($_POST['start']))
		{

			$no=0;
		}
		else{
			$no =$_POST['start'];
		}
		$data = array();
		foreach ($get_data as $row)
		{

			$btn = '<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
			$btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2" onclick="careerTipsDelete(this,'.$row->id.')" style="margin-left: 8px;">Delete</span>';
			if(!empty($row->image) && file_exists("uploads/career/".$row->image))
			{

				$img ='<a href="'.base_url('uploads/career/'.$row->image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/career/'.$row->image).'" ><a>';
			}

			else
			{
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" >';
			}

			if(strlen($row->description)>50)
			{
				$desc=substr($row->description,0,50).'...';
			}
			else {
				$desc=$row->description;
			}
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = $img;
			$nestedData[] = ucwords($row->title);
			$nestedData[] = $row->slug;
			$nestedData[] = $desc;
			$nestedData[] = $row->tipsdate;
			$nestedData[] = $btn;
			$data[] = $nestedData;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Career_tips_model->count_all(),
			"recordsFiltered" => $this->Career_tips_model->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}
	public function create_action() {
		if(isset($_FILES['image']['name'])) {
			$_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/career/'.$_POST['image'];
			$config2['upload_path'] =  getcwd().'/uploads/career/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['image'];
			}
		} else {
			$image  = "";
		}
		/*$search  = array('!', '@', '#', '$', '%', '^','&', '*', '(', ')', '-', '+', '=', '|', '~', '`', ',', '.', ';', ':', '"', '{', '}' ,"'",'?',',','>', 'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o','/');
		$replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ',' ', 'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o','-');  	
		$page_title = substr(trim(strtolower($_POST['title'])),0,150);
		$len=strlen($page_title);
		$resource_slug=str_replace($search, $replace, $page_title);
		$resource_slug=str_replace(' ','-',$resource_slug);
		for($i=0;$i<=$len;$i++) {
			$resource_slug=str_replace('--','-',$resource_slug);
			$resource_slug=strtolower($resource_slug);
		}*/
		//$resource_slug_check=$this->common_model->get_data_array(PAGES,array('page_slug'=>$resource_slug));
		//$resource_slug=urlencode($resource_slug);
		//$insert_array['page_slug']=$resource_slug;

		$data=array(
			'title'=>$_POST['title'],
			'slug'=>$_POST['slug'],
			'description'=>$_POST['description'],
			'tipsdate'=>$_POST['tipsdate'],
			'image'=>$image,
			'created_date'=>date('Y-m-d H:i:s'),
		);
		//print_r($data); die;
		$this->db->insert('career_tips',$data);
		$sitemap_date = array(
			'link'=>'/'.'career-tips/'.$_POST['slug'],
			'changefreq' => 'daily',
			'priority' => '0.80',
			'lastmod'=> date('c', time()),
		);
		$this->db->insert('sitemap',$sitemap_date);
		$this->session->set_flashdata('message', 'Career tips created successfully');
		echo "1"; exit;

	}

	public function get_value()
	{
		$get_data=$this->Crud_model->get_single('career_tips',"id='".$_POST['id']."'");
		if(!empty($get_data->image))
		{

			if(!file_exists("uploads/career/".$get_data->image))
			{
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
			}
			else
			{

				$img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/career/'.$get_data->image).'" >';
			}
		}

		else
		{
			$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
		}
		$data=array(
			'id'=>$get_data->id,
			'title'=>$get_data->title,
			'slug'=>$get_data->slug,
			'image'=>$img,
			'old_image'=>$get_data->image,
			'description'=>$get_data->description,
			'tipsdate'=>$get_data->tipsdate,
		);

		echo json_encode($data);exit;
	}

	function update_action()
	{
		if(isset($_FILES['image']['name']))
		{
			$_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/career/'.$_POST['image'];
			$config2['upload_path'] =  getcwd().'/uploads/career/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;

			$this->image_lib->initialize($config2);

			if(!$this->image_lib->resize())
			{
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			}
			else{
				$image  = $_POST['image'];
				@unlink('uploads/career/'.$_POST['old_image']);
			}
		}

		else{
			$image  = $_POST['old_image'];;
		}

		$data = array(
			'title'=> $_POST['title'],
			'slug'=> $_POST['slug'],
			'description'=> $_POST['description'],
			'tipsdate'=>$_POST['tipsdate'],
			'image'=>$image,

		);
		$this->Crud_model->SaveData('career_tips',$data,"id='".$_POST['id']."'");
		$this->session->set_flashdata('message', 'Career tips updated successfully');

		echo 1; exit;

	}

	public function delete() {
        if(isset($_POST['cid'])) {
			$this->Crud_model->DeleteData('career_tips',"id='".$_POST['cid']."'");
			$this->session->set_flashdata('message', 'Career tips deleted successfully');
			echo 1; exit;
        }
    }


}
