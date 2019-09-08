<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Googlemaps');
	}

	public function index()
	{
		//บางซื่อ
		$lat = 13.803344;
		$lng = 100.539525;
		// if($this->input->post("location") != ''){
		// 	$address = $this->input->post("location");
		// 	$location = $this->googlemaps->get_lat_long_from_address($address);
		// 	print_r($location);
		// }
		$config['center'] = $lat.",".$lng;
		$config['zoom'] = 'auto';
		$config['places'] = TRUE;
		$config['placesLocation'] = $lat.",".$lng;
		$config['placesRadius'] = 500;
		$config['placesName'] = 'Restaurant';
		$config['placesAutocompleteInputID'] = '';
		$config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
		
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		// echo $data['map']['js'];
		// echo $data['map']['html'];
		$this->load->view('Header');
		$this->load->view('V_Main', $data);
		$this->load->view('Footer');
	}
	public function getMaps()
	{
		// echo "TEST";
		$mark = $this->input->post('mark[]');
		$lat = $this->input->post('lat[]');
		$lng = $this->input->post('lng[]');
		foreach($mark as $key => $val){
			// echo $val." ".$lat[$key]." ".$lng[$key]."<br>";
			echo "
					<li>
						<a data-toggle='collapse' class='collapsed' href='#faq".$key."'>".$val."<i class='fa fa-minus-circle'></i></a>
						<div id='faq".$key."' class='collapse' data-parent='#faq-list'>
							<div class='intro-container wow fadeIn'>
								<div class='container wow fadeInUp'>
									<div class='tab-content row justify-content-center'>
										<div role='tabpanel' class='col-lg-9 tab-pane fade show active' id='day-1'>
											<div class='row schedule-item'>
												<div class='col-md-12' data-toggle='modal' data-target='#myModal1' data-ticket-type='standard-access' onclick = 'initialize(".$lat[$key].",".$lng[$key].")'>
													<p style='cursor:pointer' >
														Lat : ".$lat[$key]."
														Lng : ".$lng[$key]."
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>	
				 ";
			
		}
		// print_r($mark);
	}
	public function GetMapJs()
	{
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		
		$config['center'] = $lat.",".$lng;
		$config['zoom'] = 'auto';
	
		// echo json_encode($data);
		$marker['position'] = $lat.",".$lng;
		$this->googlemaps->add_marker($marker);

		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		echo $data['map']['html'];
		
	}
	public function GetMapHTML()
	{
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		
		$config['center'] = $lat.",".$lng;
		$config['zoom'] = 'auto';
	
		// echo json_encode($data);
		$marker['position'] = $lat.",".$lng;
		$this->googlemaps->add_marker($marker);

		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		echo $data['map']['html'];
		
	}
	public function test(){
		$address = "1600 Pennsylvania Ave NW Washington DC 20500";
		$address = str_replace(" ", "+", $address);
		$region = "USA";

		$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
		$json = json_decode($json);
		print_r($json);
		// $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		// $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		// echo $lat."
		// ".$long;
	}
}
