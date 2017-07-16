<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Material Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="{{ secure_asset('css/material-dashboard.css') }}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <!-- <link href="{{ secure_asset('css/demo.css') }}" rel="stylesheet" /> -->

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'> -->
	<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }



      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
    </style>
</head>

<body>
	<div id="map" style="position: absolute;overflow: hidden;z-index: 99;width: 50%;height: 50%;margin-left: 48%;margin-top:5%;"></div>
	<div id="infowindow-content">
		<img src="" width="16" height="16" id="place-icon">
		<span id="place-name"  class="title"></span><br>
		<span id="place-address"></span>
	</div>
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4" style="margin-top: 2%;">
						<img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="img-thumbnail img-circle" style="margin-right: 3%;width: 20%">
						<h4 style="display: inline"><b>Hello, {{ Auth::user()->name }} <a href="{{ route('logout') }}">Logout</a></b></h4>
						<h5 style="text-align: center;"><i>Please Enter the data</i></h5>
						@if(Session::has('error'))
							<div class="custom-alerts alert alert-danger fade in">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			                    {{ Session::get('error') }}
			                </div>
						@endif
						@if(Session::has('success'))
							<div class="custom-alerts alert alert-success fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								{{ Session::get('success') }}
							</div>
						@endif
						<form method="post">
							{{ csrf_field() }}
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">Phone</i>
								</span>
								<input type="text" name="phone" class="form-control" placeholder="Phone...">
							</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">Full Address</i>
								</span>
								<input type="text" name="full_addr" class="form-control" placeholder="Full Address...">
							</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">Enter Location</i>
								</span>
								<input type="text" name="location" class="form-control" id="pac-input" placeholder="Enter a location...">
							</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">Product Quantity</i>
								</span>
								<input type="text" name="qty" class="form-control" placeholder="Enter Product Quantity...">
							</div>
							<hr>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">Card Number</i>
								</span>
								<input type="text" name="card_no" class="form-control" placeholder="Card Number...">
							</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">Expiry Year</i>
								</span>
								<input type="text" name="ccExpiryYear" class="form-control" placeholder="Expiry Year...">
							</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">Expiry Month</i>
								</span>
								<input type="text" name="ccExpiryMonth" class="form-control" placeholder="Expiry Month...">
							</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">CVV</i>
								</span>
								<input type="text" name="cvvNumber" class="form-control" placeholder="CVV...">
							</div>
							<button class="btn btn-block btn-primary btn-lg" style="background-color: #000000;">Payment</button>
							<p><i>- our fake product is 50$ BTW :D, Enjoy buying nothing :D -</i></p>
						</form>
					</div>
                    <div class="col-md-8">

					</div>
                </div>

				<div class="row">
					<h2>All Orders</h2>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#order_id</th>
								<th>Phone</th>
								<th>Full Address</th>
								<th>Location</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order)
								<tr>
									<th scope="row">{{ $order->order_id }}</th>
									<td>{{ $order->phone }}</td>
									<td>{{ $order->full_addr }}</td>
									<td>{{ $order->location }}</td>
									<td>{{ $order->amount }}$</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
            </div>
        </div>


	</div>

<!--   Core JS Files   -->
<script src="{{ secure_asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>
<script src="{{ secure_asset('js/bootstrap.min.js') }}" type="text/javascript"></script>

<script>
	function initMap() {
	        var map = new google.maps.Map(document.getElementById('map'), {
	          center: {lat: -33.8688, lng: 151.2195},
	          zoom: 13
	        });
	        var card = document.getElementById('pac-card');
	        var input = document.getElementById('pac-input');
	        var types = document.getElementById('type-selector');
	        var strictBounds = document.getElementById('strict-bounds-selector');

	        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

	        var autocomplete = new google.maps.places.Autocomplete(input);

	        // Bind the map's bounds (viewport) property to the autocomplete object,
	        // so that the autocomplete requests use the current map bounds for the
	        // bounds option in the request.
	        autocomplete.bindTo('bounds', map);

	        var infowindow = new google.maps.InfoWindow();
	        var infowindowContent = document.getElementById('infowindow-content');
	        infowindow.setContent(infowindowContent);
	        var marker = new google.maps.Marker({
	          map: map,
	          anchorPoint: new google.maps.Point(0, -29)
	        });

	        autocomplete.addListener('place_changed', function() {
	          infowindow.close();
	          marker.setVisible(false);
	          var place = autocomplete.getPlace();
	          if (!place.geometry) {
	            // User entered the name of a Place that was not suggested and
	            // pressed the Enter key, or the Place Details request failed.
	            window.alert("No details available for input: '" + place.name + "'");
	            return;
	          }

	          // If the place has a geometry, then present it on a map.
	          if (place.geometry.viewport) {
	            map.fitBounds(place.geometry.viewport);
	          } else {
	            map.setCenter(place.geometry.location);
	            map.setZoom(17);  // Why 17? Because it looks good.
	          }
	          marker.setPosition(place.geometry.location);
	          marker.setVisible(true);

	          var address = '';
	          if (place.address_components) {
	            address = [
	              (place.address_components[0] && place.address_components[0].short_name || ''),
	              (place.address_components[1] && place.address_components[1].short_name || ''),
	              (place.address_components[2] && place.address_components[2].short_name || '')
	            ].join(' ');
	          }

	          infowindowContent.children['place-icon'].src = place.icon;
	          infowindowContent.children['place-name'].textContent = place.name;
	          infowindowContent.children['place-address'].textContent = address;
	          infowindow.open(map, marker);
	        });

	        // Sets a listener on a radio button to change the filter type on Places
	        // Autocomplete.
	        function setupClickListener(id, types) {
	          var radioButton = document.getElementById(id);
	          radioButton.addEventListener('click', function() {
	            autocomplete.setTypes(types);
	          });
	        }

	        setupClickListener('changetype-all', []);
	        setupClickListener('changetype-address', ['address']);
	        setupClickListener('changetype-establishment', ['establishment']);
	        setupClickListener('changetype-geocode', ['geocode']);

	        document.getElementById('use-strict-bounds')
	            .addEventListener('click', function() {
	              console.log('Checkbox clicked! New state=' + this.checked);
	              autocomplete.setOptions({strictBounds: this.checked});
	            });
	      }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPL3FVjQF5FHEIFtXdrokkpqwdTMqJzVA&libraries=places&callback=initMap" async defer></script>


</body>
</html>
