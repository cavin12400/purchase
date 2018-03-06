<?php
class purchase extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('my_model');
		$this->load->library('pdf_report');
		
	}
	public function start(){
		$data['purchase_detail'] = $this->my_model->getPurchaseDetailInfo();
		$data['paymentlink'] = "http://localhost/purchase/purchase/unpaid";
		$data['paymentText'] = "Show Unpaid";
		/*$this->load->library('pagination');
		$data['purchase_detail'] = $this->my_model->getPurchaseDetailInfo();
		$query2 = $this->db->get('tbl_purchase_detail');
		$config['base_url'] = 'http://localhost/purchase/purchase/start/';
		$config['total_rows'] = $query2->num_rows();
		$config['per_page'] = 10;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['last_tag_open'] = '<li>';
		$config['next_tag_open'] = '<li>';
		$config['prev_tag_open'] = '<li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class=\"active\"><span><b>";
		$config['cur_tag_close'] = "</b></span></li>";
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		*/
		if(isset($_POST['delete_button'])){
			if(isset($_POST['purchase_id'])){
				foreach ($_POST['purchase_id'] as $id) {
					$this->my_model->delete_order($id);
				}
				redirect('purchase/start');
			}
			else{

				$this->load->view('purchase-land',$data);
			}
			
		}
		else{
			$this->load->view('purchase-land',$data);
		}
		
	}
	public function view($purchase_id){
		$data['purchase_order_id'] = $this->my_model->getPurchaseEditInfo($purchase_id);
		$data['purchase_order'] = $this->my_model->getPurchaseOrderInfo();
		$data['purchase_detail'] = $this->my_model->getPurchaseDetailEditInfo($purchase_id);
		$data['supplier_info'] = $this->my_model->getSupplierInfo();
		$data['product_info'] = $this->my_model->getProductInfo();
		$data['details'] = $this->my_model->getDetailedView($purchase_id);
		$this->load->view('purchase-view',$data);

	}
	public function edit($purchase_id){
		$data['purchase_order_id'] = $this->my_model->getPurchaseEditInfo($purchase_id);
		$data['purchase_order'] = $this->my_model->getPurchaseOrderInfo();
		$data['purchase_detail'] = $this->my_model->getPurchaseDetailEditInfo($purchase_id);
		$data['supplier_info'] = $this->my_model->getSupplierInfo();
		$data['product_info'] = $this->my_model->getProductInfo();
		$this->load->view('purchase-edit',$data);
		if(isset($_POST['editbtn'])){
			$this->my_model->edit_batch($_POST);
			redirect('purchase/edit/'.$purchase_id,'refresh');
		}
	}
	public function pay($purchase_id){
		$data['details'] = $this->my_model->getPayment($purchase_id);
		if(isset($_POST['pay'])){
			$this->my_model->paying($purchase_id);
			redirect('purchase/pay/'.$purchase_id,'refresh');
		}
		else{
			$this->load->view('purchase-pay',$data);
		}
		

	}
	public function add(){
		$data['purchase_order'] = $this->my_model->getPurchaseOrderInfo();
		$data['supplier_info'] = $this->my_model->getSupplierInfo();
		$data['product_info'] = $this->my_model->getProductInfo();
		$this->load->view('purchase-add',$data);
		if(isset($_POST['addbtn'])){
			$this->my_model->insert_batch($_POST);
			redirect('purchase/add','refresh');
		}
	}
	public function unpaid(){
		$data['paymentlink'] = "http://localhost/purchase/purchase/start";
		$data['paymentText'] = "Show All";
		$data['purchase_detail'] = $this->my_model->unpaid();
		$this->load->view('purchase-land',$data);
	}
	public function filter(){
		$from_date = $this->input->get('starter');
		$to_date = $this->input->get('ender');
		$data['purchase_detail'] = $this->my_model->filter_date($from_date,$to_date);
		$data['paymentText'] = "Show Unpaid";
		$data['paymentlink'] = "http://localhost/purchase/purchase/unpaid";
			
		$this->load->view('purchase-land',$data);

		

	}
	public function searchdate(){
		$searchorder = $this->input->post('search');
		$data['links'] = "";
		if(isset($searchorder) and !empty($searchorder)){
			$data['purchase_detail'] = $this->my_model->search_order($searchorder);
			$data['paymentText'] = "Show Unpaid";
			$data['paymentlink'] = "http://localhost/purchase/purchase/unpaid";
			$this->load->view('purchase-land',$data);
		}
		else{
			redirect($this->start());
		}
		
	}
	public function extension(){
		$data['purchase_order'] = $this->my_model->getPurchaseOrderInfo();
		$data['supplier_info'] = $this->my_model->getSupplierInfo();
		$data['product_info'] = $this->my_model->getProductInfo();
		$this->load->view('extension',$data);
	}
	public function report_gen($purchase_id){
		$data['purchase_order_id'] = $this->my_model->getPurchaseEditInfo($purchase_id);
		$data['purchase_order'] = $this->my_model->getPurchaseOrderInfo();
		$data['purchase_detail'] = $this->my_model->getPurchaseDetailEditInfo($purchase_id);
		$data['supplier_info'] = $this->my_model->getSupplierInfo();
		$data['product_info'] = $this->my_model->getProductInfo();
		$this->load->view('report/g_report',$data);
	}


}

?>