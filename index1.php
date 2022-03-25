<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.js"></script>
	<script type="text/javascript" src="js/jquery.session.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Search Engine</title>
</head>
<body ng-app="hotelSearch" ng-Controller="hotelControl">
	<input type="number" class="hiddenPerm" id="userId" name="" value="-1" />
	<input type="hidden" class="hiddenPerm" id="userNamePlace" name="" value="none" />
	<div class="row">
		<div class="col s12 m12">
			<div class="card blue-grey darken-1">
				<div class="card-content white-text">
					<div class="row">
						<div class="col m3" >
							<span class="card-title white-text">Hotel Search Engine</span>
						</div>
						<div class="input-field col s11 m4">
							<input placeholder="For example: Hotel A" type="text" class="validate" ng-model="query">
							<label for="query">Search</label>
						</div>
						

						<div class="col s6 m1 right">
							<a class="waves-effect waves-light btn more">Filter</a>
						</div>
						
						<div class="col s6 m2 right" style="display: none;" id="logoutdiv">
							<a class="btn waves-effect waves-light red" id="logout" href="logout.php">Logout<i class="material-icons right">send</i></a>
						</div>
					
						<div class="col s6 m2 right" style="display: none;" id="bookingdiv">
							<a class="btn waves-effect waves-light red" id="booking" href="#modal1">My Bookings</a>
						</div>
						
						<div class="col s6 m2 right" id="settingdiv">
							<a class="btn waves-effect waves-light red" id="setting" href="#modal">Login<i class="material-icons right">send</i></a>
						</div>

					</div>
					<div class="row">
						<div class=""></div>
						<div class="input-field col s12 m5 hidden push-m2">
							<select id="sortCategory">
								<option value="" disabled selected>Sort By</option>
								<option value="roomCost">Room Price</option>
								<option value="locationX">location X</option>
								<option value="locationY">location Y</option>
								<option value="rating">Rating</option>
							</select>
							<label>Sort by</label>
						</div>
						<div class="switch col s12 m5 hidden push-m2">
							<label>
								Ascending
								<input type="checkbox" id="sortParam">
								<span class="lever"></span>
								Desending
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class='col s12 m4' ng-repeat="x in root">
			<div class='card blue-grey lighten-4'>
				<div class='card-content black-text'>
					<span class='card-title'><a>{{x.hotelName}}</a></span>
					<a class="right bookNow" data-hotel-id="{{x.hotelId}}" data-hotel-name="{{x.hotelName}}" data-room-cost="{{x.roomCost}}" onclick="bookNow(this);">Book Now</a>
					<p> Hotel Rating : {{x.rating}}</p>
					<p> Room Cost : {{x.roomCost}}</p>
					<!-- <p> Location : {{x.locationX + " , " + x.locationY}}</p> -->
				</div>
			</div>
		</div>
	</div>
	<div id="modal" class="modal">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">
					<ul class="tabs">
						<li class="tab col s6"><a id="init" href="#login">login</a></li>
						<li class="tab col s6"><a href="#signup">signup</a></li>
					</ul>
				</div>
				<div id="login" class="col s12">
					<p><h4>Login</h4></p>
					<form action="" enctype="multipart/form-data">
						<div class="input-field col s12">
							<i class="material-icons prefix" id="userNameParent">supervisor_account</i>
							<input id="userName" type="text" name="userName" class="validate" required="">
							<label for="icon_prefix">User Name</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">vpn_key</i>
							<input id="password" type="password" name="userName" class="validate" required="">
							<label for="icon_prefix">Password</label>
						</div>
					</form>
					<div class="modal-footer">
						<a id="loginButton" class=" modal-action modal-close waves-effect waves-green btn-flat">Login</a>
						<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
					</div>
				</div>
				<div id="signup" class="col s12">
					<p><h4>Sign Up</h4></p>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="input-field col s12">
							<i class="material-icons prefix" id="userNameParent">supervisor_account</i>
							<input id="newUserName" type="text" name="userName" class="validate" required="">
							<label for="icon_prefix">New User Name</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">vpn_key</i>
							<input id="newPassword" type="password" class="validate" required="">
							<label for="icon_prefix">New Password</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">vpn_key</i>
							<input id="rePassword" type="password" class="validate" required="">
							<label for="icon_prefix">Re-type Password</label>
						</div>
					</form>
					<div class="modal-footer">
						<a href="#!"  id="signUpButton" class=" modal-action modal-close waves-effect waves-green btn-flat">Sign Up</a>
						<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="bookingModal" class="modal">
		<div class="modal-content">
		<h2>Confirm Booking </h2>
		<p>Are you sure you want to book the hotel?</p>
		<div class="row">
		<div class="col s6">
		<p id="modalHotelName"></p>
		</div>
		<div class="col s6">
		</div>
		<p id="modalPrice" class="right"></p>
		</div>
		<div class="modal-footer">
			<a id="bookButton" class=" modal-action modal-close waves-effect waves-green btn-flat">Book</a>
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
		</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/index.js">
</script>
<script>
	var app = angular.module('hotelSearch', []);
	app.controller('hotelControl', function($scope,$http) {
		$scope.$watch('query',function(val){
			var searchParam = $("#sortCategory").val();
			var sortParam = $("#sortParam").prop("checked");
			if(sortParam == false)
				sortParam = "asc";
			else 
				sortParam = "desc";
			if(searchParam == "")
			{
				$http.get("getHotels.php?q="+val).then(function(response)
				{

					$scope.root = response.data.root;
				});
			}
			else
			{
				$http.get("getHotels.php?q="+val+"&s="+searchParam+"&u="+sortParam).then(function(response)
				{
					$scope.root = response.data.root;
				});
			}
		} );

	});


</script>
</html>