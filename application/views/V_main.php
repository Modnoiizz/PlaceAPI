<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<p id="gmapJs"><?php echo $map['js']; ?></p>
	<script>
		function GetPosition(Result){
			var mark=[],lat=[],lng=[];
			for(var i = 0 ; i<Result.length; i++){
				// Result[i] = Result[i]['mark']+','+Result[i]['lat']+','+Result[i]['lng'];
				mark[i] = Result[i]['mark'];
				lat[i]  = Result[i]['lat'];
				lng[i]  = Result[i]['lng'];
			}
			// console.log(mark[0]);
			var url = "<?php echo base_url()."index.php/C_main/getMaps"; ?>";
			$.post(url, {mark:mark, lat:lat, lng:lng},
			function ( data ){
				$( "#txt" ).html( data );
			});
		}
		function ClickMap(lat,lng){
			//ทำยังไม่เสร็จสมบูรณ์
			// alert(lat);
			var url = "<?php echo base_url()."index.php/C_main/GetMapJs"; ?>";
			$.post(url, {lat:lat, lng:lng},
			function ( data ){
				$( "#gmapJs" ).html( data );
			});
			var url1 = "<?php echo base_url()."index.php/C_main/GetMapHTML"; ?>";
			$.post(url1, {lat:lat, lng:lng},
			function ( data1 ){
				$( "#gmapHTML" ).html( data1 );
			});
		}
	</script>
</head>
<body>
	<!-- <section id="subscribe">
		<div class="container wow fadeInUp">
			<div class="section-header">
			<h2>Restaurant</h2>
			<p>Search Location.</p>
			</div>

			<form method="POST" action="<?php echo base_url()."index.php/C_main/"; ?>">
			<div class="form-row justify-content-center">
				<div class="col-auto">
					<input type="text" class="form-control" placeholder="Enter Location" name="location">
				</div>
				<div class="col-auto">
					<button type="submit">Search</button>
				</div>
			</div>
			</form>
		</div>
	</section>
	 -->
	<p id="gmapHTML"><?php echo $map['html']; ?></p>
	<main id="main">
		<section id="faq" class="wow fadeInUp">
		<div class="container">

			<div class="section-header">
			<h2>Restaurant</h2>
			</div>

			<div class="row justify-content-center">
			<div class="col-lg-9">
				<ul id="faq-list">	
					<p id="txt">
				</ul>
			</div>
			</div>

		</div>

		</section>
	</div>
	<div id="myModal" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">MAP</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<div class="row">
					<div class="col-md-12 modal_body_map">
					<div class="location-map" id="location-map">
						<div style="width: 600px; height: 400px;" id="map_canvas"></div>
					</div>
					</div>
				</div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
</body>
</html>
