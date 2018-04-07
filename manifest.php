<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="js/dragcheck.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link href="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js"></script>

	<link href="https://zikula.github.io/bootstrap-docs/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

	<script src="js/country_regions.js"></script>

<style type="text/css">

html,body{
	height:100%;
	background:#252525;
}

.unity{
	background:white;
}

.table-container{
	max-height:450px;
	overflow-y: scroll;
}
table {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
}

table td {
		border: 1px solid #ddd;
		padding: 8px;
}
table th {
		border: 0;
		padding: 8px;
}
table td:first-child, table th:first-child,
table td:last-child, table th:last-child{
	border-left: 0;
	border-right: 0;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #428bca;
		color: white;
		text-align:center;
}
table.list tr{

}
table.list tr td{
	text-align:center;
}

.table-container{
	padding:0;
}

.table-container .btn{
	padding: 1px 13px !important;
}
.table-container .btn.editable-cancel{
	background:#dc3545;
	color:white;
}
.table-container .btn.editable-cancel:hover{
	background:#c82333;
}

.lists .actionbtns .btn{
	margin:10px 5px;
}

.lists .actionbtns .btn.delete-confirm{
	display:none;
}

.exhibitor-info .row{
	padding:10px 0;
}
.exhibitor-info ul.noli > li:first-child{
	font-weight:bold;
}

ul.noli{
	margin:0;
	padding:0;
}
ul.noli > li{
	list-style-type: none;
}


.modal-body .form-horizontal .col-sm-2,
.modal-body .form-horizontal .col-sm-10 {
		width: 100%
}

.modal-body .form-horizontal .control-label {
		text-align: left;
}
.modal-body .form-horizontal .col-sm-offset-2 {
		margin-left: 15px;
}

.lists .row.bordered{
	border:1px solid #dddddd;
}
.lists h2{
	background: #f2f2f2;
    width: 100%;
    padding: 10px 17px;
    margin: 0;
}
div#edit_row{
    background: #428bca;
    border: 4px solid #347ab5;
    width: 10px;
    padding: 6px;
    margin: 0 auto;
    cursor:pointer;
}
</style>
	<script>
$(window).load(function(){
	$('table tbody').dragcheck({
	container: 'tr', // Using the tr as a container
	onSelect: function(obj, state) {
					obj.prop('checked', state);
			}
	});
});


$.fn.editable.defaults.mode = 'inline';
$.fn.editable.defaults.showbuttons = false;
$.fn.editable.defaults.onblur = "submit";
var countries;

$(document).ready(function(){


	$.ajax({
		type: "POST",
		url: 'https://gentle-dawn-65313.herokuapp.com/exhibitorinfo',
		data: {"account_id":GET("id")},
		success: function(response){
			console.log(response);

			for(var key in response){
				if(response[key] == null || response[key] == ""){
					if(key == "attendees" || key == "guests" || key == "attendee_allotment"){
						response[key] = "0";
					}else{
						response[key] = "null";
					}
				}
			}

			$(".exhibitor-info .name").html(response['name']);
			$(".exhibitor-info .boothnumber").html(response['booth_number']);
			$(".exhibitor-info .country").html(response['country']);
			$(".exhibitor-info .directory").html(response['directory_cname']);
			$(".exhibitor-info .attendee_allotment").html(response['attendee_allotment']);
			$(".exhibitor-info .attendees").html(response['attendees']);
			$(".exhibitor-info .guests").html(response['guests']);
		},
		dataType: 'json'
	});

	$.ajax({
		type: "POST",
		url: "https://gentle-dawn-65313.herokuapp.com/exhibitors",
		data: {"account_id":GET("id"), "orderby": GET("exh_orderby"), "order": GET("exh_order")},
		success: function(data){
			data = JSON.parse(data);

			var data_build = [];
			for (var i = data.length - 1; i >= 0; i--) {
				if(data[i]['country__c'] != null){
					data[i]['country__c'] = data[i]['country__c'];
				}
				for(var key in data[i]){
					if(data[i][key] == null){
						data[i][key] = '';
					}
				}
				data_build.push([
					'<span id="confirmation_number__c" data-val="' + data[i]['confirmation_number__c'] + '">' + data[i]['confirmation_number__c'] + '</span>',
					'<a href="#" class="editable-dropdown" id="country__c" sql_id="' + data[i]['id'] + '" selected="' + data[i]['country__c'] + '" data-val="' + data[i]['country__c'] + '">' + data[i]['country__c'] + '</a>',
					'<a href="#" class="editable" id="position__c" sql_id="'+ data[i]['id'] +'" data-type="text" data-title="Enter position" data-val="' + data[i]['position__c'] + '">' + data[i]['position__c'] + '</a>',
					'<a href="#" class="editable editable-email" id="email__c" sql_id="'+ data[i]['id'] +'" data-type="text" data-title="Enter email" data-val="' + data[i]['email__c'] + '">' + data[i]['email__c'] + '</a>',
					'<a href="#" class="editable" id="last_name__c" sql_id="'+ data[i]['id'] +'" data-type="text" data-title="Enter last name" data-val="' + data[i]['last_name__c'] + '">' + data[i]['last_name__c'] + '</a>',
					'<a href="#" class="editable" id="first_name__c" sql_id="'+ data[i]['id'] +'" data-type="text" data-title="Enter first name" data-val="' + data[i]['first_name__c'] + '">' + data[i]['first_name__c'] + '</a>',
					'<input class="remove-user" sql_id="' + data[i]['id'] + '" type="checkbox" value="1" />',
					'<div id="edit_row" sql_id="'+ data[i]['id'] +'"></div>',
				]);
			}
					var lb = list_build(
				['Edit Row', 'Remove?', 'First Name', 'Last Name', 'Email', 'Position', 'Country/Region', 'Confirmation Number'],
				data_build
			);
			$('table.list.exhibitors thead').html(
				lb[0]
			).promise().done(function(){
				$('table.list.exhibitors tbody').html(
					lb[1]
				).promise().done(function(){


					var editable_obj = {
						showbuttons: false,
						success: function(response, newValue){
							console.log([response, newValue, $(this).attr('sql_id')]);
							$.ajax({
								type: "POST",
								url: 'https://gentle-dawn-65313.herokuapp.com/updatelist',
								data: {"account_id":GET("id"),'id': $(this).attr('sql_id'), 'field': $(this).attr('id'), 'value': newValue},
								onblur: 'submit',
								success: function(response){
									console.log(response);
								},
								dataType: 'json'
							});
						},
						onerror:function(response){
							console.log("error");
						}
					};

					$('table.list.exhibitors .editable').editable(editable_obj);
					editable_obj['validate'] = function(value){
						console.log(value);
						if($.trim(value) == '') {
							$(".emailValidationForm").modal("show");
							return 'This field is required.'
						}else if(!validateEmail($.trim(value))){
							$(".emailValidationForm").modal("show");
							console.log('not valid email');
							return 'This is not a valid email';
						}
					};
					$('table.list.exhibitors .editable-email').editable(editable_obj);




					$('table.list.exhibitors .editable').editable(editable_obj);

					var country_regions_source = [];
					for(var key in window.country_regions){
						var country_region_formatted = window.country_regions[key];
						country_regions_source.push({id: country_region_formatted, text: country_region_formatted});
					}

					
					$.ajax({
						type: "GET",
						url: 'https://gentle-dawn-65313.herokuapp.com/getcountries',
						cache: true,
						data: {},
						dataType: 'json',
						success: function(response){
							$('table.list.exhibitors .editable-dropdown#country__c').editable({
								source: response,
								value: $(this).attr('selected'),
								select2:{
									placeholder: 'Country/Region'
								},
								type:'select2',
								success: function(response, newValue){
									console.log('go' + newValue);
									$.ajax({
										type: "POST",
										url: 'https://gentle-dawn-65313.herokuapp.com/updatelist',
										data: {"account_id":GET("id"),'id': $(this).attr('sql_id'), 'field': $(this).attr('id'), 'value': newValue},
										success: function(response){
											console.log(response);
										},
										dataType: 'json'
									});
								}
							});
						}
					});
				});
			});
		}
	});
	$.ajax({
		type: "POST",
		url: "https://gentle-dawn-65313.herokuapp.com/guests",
		data: {"account_id":GET("id"), "orderby": GET("guest_orderby"), "order": GET("guest_order")},
		success: function(data){
			data = JSON.parse(data);

			var data_build = [];
			for (var i = data.length - 1; i >= 0; i--) {
				if(data[i]['country__c'] != null){
					data[i]['country__c'] = data[i]['country__c'];
				}
				for(var key in data[i]){
					if(data[i][key] == null){
						data[i][key] = '';
					}
				}
				data_build.push([
					'<span id="confirmation_number__c" data-val="' + data[i]['confirmation_number__c'] + '">' + data[i]['confirmation_number__c'] + '</span>',
					'<a href="#" class="editable-dropdown" id="country__c" sql_id="' + data[i]['id'] + '" selected="' + data[i]['country__c'] + '" data-val="' + data[i]['country__c'] + '">' + data[i]['country__c'] + '</a>',
					'<a href="#" class="editable" id="position__c" sql_id="'+ data[i]['id'] +'" data-type="text" data-title="Enter position" data-val="' + data[i]['position__c'] + '">' + data[i]['position__c'] + '</a>',
					'<a href="#" class="editable editable-email" id="email__c" sql_id="'+ data[i]['id'] +'" data-type="text" data-title="Enter email" data-val="' + data[i]['email__c'] + '">' + data[i]['email__c'] + '</a>',
					'<a href="#" class="editable" id="last_name__c" sql_id="'+ data[i]['id'] +'" data-type="text" data-title="Enter last name" data-val="' + data[i]['last_name__c'] + '">' + data[i]['last_name__c'] + '</a>',
					'<a href="#" class="editable" id="first_name__c" sql_id="'+ data[i]['id'] +'" data-type="text" data-title="Enter first name" data-val="' + data[i]['first_name__c'] + '">' + data[i]['first_name__c'] + '</a>',
					'<input class="remove-user" sql_id="' + data[i]['id'] + '" type="checkbox" value="1" />',
					'<div id="edit_row" sql_id="'+ data[i]['id'] +'"></div>'
				]);
			}
					var lb = list_build(
				['Edit Row', 'Remove?', 'First Name', 'Last Name', 'Email', 'Position', 'Country/Region', 'Confirmation Number'],
				data_build
			);



			$('table.list.guests thead').html(
				lb[0]
			).promise().then(function(){
				$('table.list.guests tbody').html(
					lb[1]
				).promise().then(function(){
					var editable_obj = {
						showbuttons: false,
						onblur: 'submit',
						success: function(response, newValue){
							console.log([response, newValue, $(this).attr('sql_id')]);
							$.ajax({
								type: "POST",
								url: 'https://gentle-dawn-65313.herokuapp.com/updatelist',
								data: {"account_id":GET("id"),'id': $(this).attr('sql_id'), 'field': $(this).attr('id'), 'value': newValue},
								success: function(response){
									console.log(response);
								},
								dataType: 'json'
							});
						},
						error: function(data) {
				            var msg = '';
				            if(data.errors) {                //validation error
				                $.each(data.errors, function(k, v) { msg += k+": "+v+"<br>"; });  
				            } else if(data.responseText) {   //ajax error
				                msg = data.responseText; 
				            }
				            $('.emailValidationForm').modal('show');
				        }
					};
					$('table.list.guests .editable').editable(editable_obj);
					editable_obj['validate'] = function(){
						if($.trim(value) == '') {
							$(".emailValidationForm").modal("show");
							return 'This field is required.'
						}else if(!validateEmail($.trim(value))){
							$(".emailValidationForm").modal("show");
							console.log('not valid email');
							return 'This is not a valid email';
						}
					};
					$('table.list.guests .editable-email').editable(editable_obj);

					var country_regions_source = [];
					for(var key in window.country_regions){
						var country_region_formatted = window.country_regions[key];
						country_regions_source.push({id: country_region_formatted, text: country_region_formatted});
					}

					
					$.ajax({
						type: "GET",
						url: 'https://gentle-dawn-65313.herokuapp.com/getcountries',
						cache: true,
						data: {},
						dataType: 'json',
						success: function(response){
							$('table.list.guests .editable-dropdown#country__c').editable({
								source: response,
								value: $(this).attr('selected'),
								select2:{
									placeholder: 'Country/Region'
								},
								type:'select2',
								success: function(response, newValue){
									console.log('go' + newValue);
									$.ajax({
										type: "POST",
										url: 'https://gentle-dawn-65313.herokuapp.com/updatelist',
										data: {"account_id":GET("id"),'id': $(this).attr('sql_id'), 'field': $(this).attr('id'), 'value': newValue},
										success: function(response){
											console.log(response);
										},
										dataType: 'json'
									});
								}
							});
						}
					});
				});
			});
		}
	});
	$.ajax({
		type: "GET",
		url: 'https://gentle-dawn-65313.herokuapp.com/getcountries',
		cache: true,
		data: {},
		success: function(response){
			countries = response;
			for(var key in response){
				$('select[name="country"]').each(function(){
					$(this).append("<option value='" + response[key] + "'>"+ response[key] +"</option>");
				});
			}
		},
		dataType: 'json'
	});

	$(document).on('click', '.exhibitor-list .actionbtns .btn.delete-confirm',function(){
		var sql_ids = [];
		var checked = $('.exhibitor-list tr input.remove-user[type="checkbox"]:checked');
		checked.each(function(key, val){
			sql_ids.push($(val).attr('sql_id'));
		});
		$.ajax({
			type: "POST",
			url: 'https://gentle-dawn-65313.herokuapp.com/removeuser',
			data: {"account_id":GET("id"), 'ids': JSON.stringify(sql_ids)},
			success: function(response){
				checked.parents("tr").remove();
				console.log(response);
			},
			dataType: 'json'
		});
	});

	$(document).on('click', '.guests-list .actionbtns .btn.delete-confirm',function(){
		var sql_ids = [];
		var checked = $('.guests-list tr input.remove-user[type="checkbox"]:checked');
		checked.each(function(key, val){
			sql_ids.push($(val).attr('sql_id'));
		});
		$.ajax({
			type: "POST",
			url: 'https://gentle-dawn-65313.herokuapp.com/removeuser',
			data: {"account_id":GET("id"), 'ids': JSON.stringify(sql_ids)},
			success: function(response){
				checked.parents("tr").remove();
				console.log(response);
			},
			dataType: 'json'
		});
	});

});

$(document).on('click','.list.exhibitors input[type="checkbox"]', function(){
	var btn_toggle = true;
	$('.list.exhibitors input[type="checkbox"]').each(function(key, value){
		if($(value).is(':checked')){
			button_toggle = true;
			return false; 
		}else{
			button_toggle = false;
		}
	});
	if(button_toggle){
		$('.exhibitor-list .btn-danger').show();
	}else{
		$('.exhibitor-list .btn-danger').hide();
	}
});
$(document).on('click','.list.guests input[type="checkbox"]', function(){
	var btn_toggle = true;
	$('.list.guests input[type="checkbox"]').each(function(key, value){
		if($(value).is(':checked')){
			button_toggle = true;
			return false; 
		}else{
			button_toggle = false;
		}
	});
	if(button_toggle){
		$('.guests-list .btn-danger').show();
	}else{
		$('.guests-list .btn-danger').hide();
	}
});

$(document).on("submit", "#AttendeeForm form.needs-validation, #GuestForm form.needs-validation", function( event ) {
	event.preventDefault();
    event.stopPropagation();
	var $form = $(this).parents(".addform").find("form.needs-validation");
    this.classList.add('was-validated');
    var form_data = { };
	$.each($form.serializeArray(), function() {
		form_data[this.name] = this.value;
	});
    if(this.checkValidity() !== false){
		$.ajax({
			type: "POST",
			url: 'https://gentle-dawn-65313.herokuapp.com/addattendee',
			data: {"account_id":GET("id"), 'data': form_data},
			success: function(response){
				if(response == 2){
					$(".addform").modal("hide");
					$(".warningForm").modal("show");
				}else if(response == 1){
					$(".addform").modal("hide");
					location.reload();
				}
				console.log(response);
			},
			dataType: 'json'
		});
	}
  });

$(document).on("click", ".addform .save", function( event ) {
	var $form = $(this).parents(".addform").find("form.needs-validation");
	$form.trigger("submit");
});

  // Email validation.
$(document).on('change', '.needs-validation input[type="email"]', function() {
	var email = $(this);
	if (email.is(':invalid')) {
		email.removeClass('is-valid').addClass('is-invalid');
		email.siblings(".invalid-feedback").text(email.prop("validationMessage"))
	} else {
		email.removeClass('is-invalid').addClass('is-valid');
	}
});



$(document).on("submit", ".recaptchaform form", function( event ) {
	event.preventDefault();
    event.stopPropagation();
	var $form = $(this).parents(".recaptchaform").find("form");
    var form_data = { };
	$.each($form.serializeArray(), function() {
		form_data[this.name] = this.value;
	});
	if(Object.keys(form_data).length > 0){
		$.ajax({
			type: "POST",
			url: 'https://gentle-dawn-65313.herokuapp.com/recaptchavalidate',
			data: form_data,
			success: function(response){
				if(response == 1){
					$(".recaptchaform").modal("hide");
				}
			},
			error: function(response){
				console.log(response);
			},
			dataType: 'json'
		});
	}
  });



$(document).on("click", ".recaptchaform .submit", function( event ) {
	var $form = $(this).parents(".recaptchaform").find("form");
	$form.trigger("submit");
});


$(document).on("click", ".list.exhibitors th", function( event ) {
	var field = '';
	switch($(this).text()){
		case 'First Name':{
			field = 'first_name__c';
			break;
		}
		case 'Last Name':{
			field = 'last_name__c';
			break;
		}
		case 'Email':{
			field = 'email__c';
			break;
		}
		case 'First Name':{
			field = 'first_name__c';
			break;
		}
		case 'Position':{
			field = 'position__c';
			break;
		}
		case 'Country/Region':{
			field = 'country__c';
			break;
		}
		case 'Confirmation Number':{
			field = 'confirmation_number__c';
			break;
		}
	}
	var get = (!GET('exh_order'))? 'ASC' : GET('exh_order');
	if(!GET('exh_order')){
		get = "ASC";
	}else{
		if(GET('exh_order').toLocaleLowerCase() == "asc"){
			get = "desc";
		}else{
			get = "asc";
		}
	}
	var new_search = location.search;
	if(new_search.indexOf("exh_orderby=") == -1){
		if(new_search != ""){
			new_search += "&";
		}else{
			new_search = "?";
		}
		new_search += "exh_orderby=" + field;
	}
	if(new_search.indexOf("exh_order=") == -1){
		if(new_search != ""){
			new_search += "&";
		}else{
			new_search = "?";
		}
		new_search += "exh_order=" + get;
	}
	location.search = new_search.replace(/exh_orderby=[^&$]*/i, 'exh_orderby=' + field).replace(/exh_order=[^&$]*/i, 'exh_order=' + get);

});
$(document).on("click", ".list.guests th", function( event ) {
	var field = '';
	switch($(this).text()){
		case 'First Name':{
			field = 'first_name__c';
			break;
		}
		case 'Last Name':{
			field = 'last_name__c';
			break;
		}
		case 'Email':{
			field = 'email__c';
			break;
		}
		case 'First Name':{
			field = 'first_name__c';
			break;
		}
		case 'Position':{
			field = 'position__c';
			break;
		}
		case 'Country/Region':{
			field = 'country__c';
			break;
		}
		case 'Confirmation Number':{
			field = 'confirmation_number__c';
			break;
		}
	}
	var get = (!GET('guest_order'))? 'ASC' : GET('guest_order');
	if(!GET('guest_order')){
		get = "ASC";
	}else{
		if(GET('guest_order').toLocaleLowerCase() == "asc"){
			get = "desc";
		}else{
			get = "asc";
		}
	}
	var new_search = location.search;
	if(new_search.indexOf("guest_orderby=") == -1){
		if(new_search != ""){
			new_search += "&";
		}else{
			new_search = "?";
		}
		new_search += "guest_orderby=" + field;
	}
	if(new_search.indexOf("guest_order=") == -1){
		if(new_search != ""){
			new_search += "&";
		}else{
			new_search = "?";
		}
		new_search += "guest_order=" + get;
	}
	location.search = new_search.replace(/guest_orderby=[^&$]*/i, 'guest_orderby=' + field).replace(/guest_order=[^&$]*/i, 'guest_order=' + get);

});

$(document).on("click", ".list.exhibitors div#edit_row", function( event ) {
	var data_ = {};
	data_['sql_id'] = $(this).attr('sql_id');
	data_['attendeetype'] = "Exhibitor";
	$(this).closest("table tr").find("[data-val]").each(function(key, val){
		data_[$(this).attr("id")] = $(this).attr("data-val");
	});
	console.log(data_);
	$.ajax({
		url: "partials/edit_row_modal",
		type: "get", //send it through get method
		data: data_,
		success: function(response) {
	  		$(".edit_row_modal_container").html(response);
	  		for(var key in countries){
				$('select[name="country"]').each(function(){
					if(countries[key] == data_['country__c']){
						$(this).append("<option value='" + countries[key] + "' selected>"+ countries[key] +"</option>");
					}else{
						$(this).append("<option value='" + countries[key] + "'>"+ countries[key] +"</option>");
					}
				});
			}
			$("#editRow").modal({backdrop: 'static', keyboard: false});
		}
	});
});

$(document).on("click", ".list.guests div#edit_row", function( event ) {
	var data_ = {};
	data_['sql_id'] = $(this).attr('sql_id');
	data_['attendeetype'] = "Guest";
	$(this).closest("table tr").find("[data-val]").each(function(key, val){
		data_[$(this).attr("id")] = $(this).attr("data-val");
	});
	console.log(data_);
	$.ajax({
		url: "partials/edit_row_modal",
		type: "get", //send it through get method
		data: data_,
		success: function(response) {
	  		$(".edit_row_modal_container").html(response);
	  		for(var key in countries){
				$('select[name="country"]').each(function(){
					if(countries[key] == data_['country__c']){
						$(this).append("<option value='" + countries[key] + "' selected>"+ countries[key] +"</option>");
					}else{
						$(this).append("<option value='" + countries[key] + "'>"+ countries[key] +"</option>");
					}
				});
			}
			$("#editRow").modal({backdrop: 'static', keyboard: false});
		}
	});
});

$(document).on("submit", "#editRow form.needs-validation", function( event ) {
	event.preventDefault();
    event.stopPropagation();
	var $form = $(this).parents("#editRow").find("form.needs-validation");
    this.classList.add('was-validated');
    var form_data = { };
	$.each($form.serializeArray(), function() {
		form_data[this.name] = this.value;
	});
    if(this.checkValidity() !== false){
    	console.log(form_data);
		$.ajax({
			type: "POST",
			url: 'updateattendee',
			data: {"account_id":GET("id"), 'data': form_data},
			success: function(response){
				console.log("Made it to ajax");
				console.log(response);
				if(response == 1){
					$("#editRow").modal("hide");
					location.reload();
				}
				console.log(response);
			}
		});
	}
  });
$(document).on("click", "#editRow .save", function( event ) {
	var $form = $(this).closest("#editRow").find("form.needs-validation");
	$form.trigger("submit");
});
function list_build(header, data){//obj, arr of obj
	var th_string = '';
	for(var key in header){
		th_string += '<th>' + header[key] + '</th>';
	}


	var tr_string = '';
	for (var a = data.length - 1; a >= 0; a--) {
		tr_string += '<tr>';
		for (var b = data[a].length - 1; b >= 0; b--) {
			tr_string += '<td>' + data[a][b] + '</td>';
		}
		tr_string += '</tr>';
	}

	return [th_string, tr_string];
}

function GET(name, url) {
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
				results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email));
}

	</script>
</head>
<body>
<div class="edit_row_modal_container"></div>
<!-- Attendee Modal -->
<div class="modal fade addform" id="AttendeeForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Add Attendee
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
						
			<!-- Modal Body -->
			<div class="modal-body">
				<form role="form" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="firstnameinput">First Name</label>
						<input type="text" name="firstname" class="form-control" id="firstnameinput" placeholder="enter first name"/>
						<div class="invalid-feedback">
        				  Please provide a first name.
        				</div>
					</div>
					<div class="form-group">
						<label for="lastnameinput">Last Name</label>
						<input type="text" name="lastname" class="form-control" id="lastnameinput" placeholder="enter last name"/>
						<div class="invalid-feedback">
        				   Please provide a last name.
        				</div>
					</div>
					<div class="form-group">
						<label for="emailinput">Email</label>
						<input type="email" name="email" class="form-control" id="emailinput" placeholder="enter email"/>
						<div class="invalid-feedback">
        				  Please provide a propper email
        				</div>
					</div>
					<div class="form-group">
						<label for="countryinput">Country</label>
						<select name="country" class="dropdown_countries form-control" id="countryinput" placeholder="enter country">
						</select>
						<div class="invalid-feedback">
        				  Please provide a country.
        				</div>
					</div>
					<div class="form-group">
						<label for="positioninput">Position</label>
						<input name="position" type="text" class="form-control" id="positioninput" placeholder="enter position"/>
						<div class="invalid-feedback">
        				  Please provide a position.
        				</div>
					</div>
					<input type="hidden" name="attendeetype" class="form-control" id="attendeetypeinput" value="Exhibitor"/>
				</form>	
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary save">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Guest Modal -->
<div class="modal fade addform" id="GuestForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Add Guest
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
						
			<!-- Modal Body -->
			<div class="modal-body">
				<form role="form" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="firstnameinput">First Name</label>
						<input type="text" class="form-control" id="firstnameinput" placeholder="enter first name"/>
						<div class="invalid-feedback">
        				  Please provide a first name.
        				</div>
					</div>
					<div class="form-group">
						<label for="lastnameinput">Last Name</label>
						<input type="text" class="form-control" id="lastnameinput" placeholder="enter last name"/>
						<div class="invalid-feedback">
        				   Please provide a last name.
        				</div>
					</div>
					<div class="form-group">
						<label for="emailinput">Email</label>
						<input type="email" name="email" class="form-control" id="emailinput" placeholder="enter email"/>
						<div class="invalid-feedback">
        				  Please provide a propper email
        				</div>
					</div>
					<div class="form-group">
						<label for="countryinput">Country</label>
						<select name="country" class="dropdown_countries form-control" id="countryinput" placeholder="enter country">
						</select>
						<div class="invalid-feedback">
        				  Please provide a country.
        				</div>
					</div>
					<div class="form-group">
						<label for="positioninput">Position</label>
						<input type="text" class="form-control" id="positioninput" placeholder="enter position"/>
						<div class="invalid-feedback">
        				  Please provide a position.
        				</div>
					</div>
					<input type="hidden" name="attendeetype" class="form-control" id="attendeetypeinput" value="Guest"/>
				</form>	
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary save">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- recaptcha Modal -->
<div class="modal fade recaptchaform" id="recaptchaform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Verify Identity from Spam Protection
				</h4>
			</div>
						
			<!-- Modal Body -->
			<div class="modal-body">
				<form action="?" method="POST">
			      <div id="recaptcha"></div>
			      <br/>
			    </form>
			    <script type="text/javascript">
			      var verifyCallback = function(response) {
			        console.log(response);
			      };
			      var widgetId1;
			      var widgetId2;
			      var onloadCallback = function() {
			      	$.ajax({
						type: "GET",
						url: 'https://gentle-dawn-65313.herokuapp.com/recaptchavalidate',
						data: {},
						success: function(response){
							if(response != 1){
								$('.recaptchaform').modal({backdrop: 'static', keyboard: false})
							}
							grecaptcha.render('recaptcha', {
								'sitekey' : '6LddnE8UAAAAAKbWMOXREN-YKqnJnYAYn_o3uo6_',
								'callback' : verifyCallback,
								'theme' : 'light'
							});
							console.log(response);
						},
						error: function(response){
							console.log(response);
						},
						dataType: 'json'
					});
			      };
			    </script>
			    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback"
			        async defer>
			    </script>
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-primary submit" data-dismiss="modal">Submit</button>
			</div>
		</div>
	</div>
</div>

<!-- warning Modal -->
<div class="modal fade warningForm" id="warningForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Warning
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
						
			<!-- Modal Body -->
			<div class="modal-body">
				<p>The number of registered attendees cannot exceed the number of attendees allotted.</p>
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>

<!-- warning Modal -->
<div class="modal fade emailValidationForm" id="emailValidationForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Warning
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
						
			<!-- Modal Body -->
			<div class="modal-body">
				<p>Please enter a valid email.</p>
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>



<div class="unity">
	<div class="container exhibitor-info">
		<div class="row">
			<div class="col-md-3">
				<ul class="noli">
					<li>Company Name</li>
					<li class="name"></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="noli">
					<li>Booth Number</li>
					<li class="boothnumber"></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="noli">
					<li>Company Name in Directory</li>
					<li class="directory"></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="noli">
					<li>Country</li>
					<li class="country"></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<ul class="noli">
					<li>Attendee Allotment</li>
					<li class="attendee_allotment"></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="noli">
					<li># Attendees</li>
					<li class="attendees"></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="noli">
					<li># Guests</li>
					<li class="guests"></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container lists exhibitor-list">
		<div class="row bordered">
			<h2>Attendee List</h2>
		</div>
		<div class="row bordered">
			<div class="table-container col-12">
			<table class='list exhibitors'>
				<thead>
				</thead>
				<tbody>
					
				</tbody>
			</table>
			</div>
		</div>
		<div class="row actionbtns">
			<div class="col-centered">
				<button type="button" class="btn btn-danger delete-confirm">Are you sure?</button>
				<button type="button" class="btn btn-success add-attendee" data-toggle="modal" data-target="#AttendeeForm">Add Attendee</button>
			</div>
		</div>
	</div>
	<div class="container lists guests-list">
		<div class="row bordered">
			<h2>Guest List</h2>
		</div>
		<div class="row bordered">
			<div class="table-container col-12">
			<table class='list guests'>
				<thead>
				</thead>
				<tbody>
					
				</tbody>
			</table>
			</div>
		</div>
		<div class="row actionbtns">
			<div class="col-centered">
				<button type="button" class="btn btn-danger delete-confirm">Are you sure?</button>
				<button type="button" class="btn btn-success add-guest" data-toggle="modal" data-target="#GuestForm">Add Guest</button>
			</div>
		</div>
	</div>
</div>
version 3
</body>
</html>