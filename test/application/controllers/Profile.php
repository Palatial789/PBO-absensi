<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Public_model');
    is_logged_in();
  }
  public function index()
  {
      $data['title'] = 'My Profile';
      $data['account'] = $this->Public_model->getAccount($this->session->userdata['username']);
      
      // Retrieve attendance data
      $start = '2023-04-01'; // Replace with your desired start date
      $end = '2023-06-31'; // Replace with your desired end date
      $dept = $data['account']['department_id'];
      $data['attendance'] = $this->Public_model->get_attendance($start, $end, $dept);
      
      // Get the department name from department_id
      $data['account']['department'] = $this->Public_model->getDepartmentName($dept);
      
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('templates/topbar');
      $this->load->view('profile/index', $data);
      $this->load->view('templates/footer');
  }
}
