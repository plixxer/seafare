<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link href="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>

	<style type="text/css">
		
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


	</style>

<script type="text/javascript">
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
				url: 'recaptchavalidate',
				data: form_data,
				success: function(response){
					if(response == 1){
						$(".recaptchaform").modal("hide");
						window.location = "/manifest" + window.location.search;
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
</script>
</head>
<body>
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
						url: 'recaptchavalidate',
						data: {},
						success: function(response){
							console.log(response);
							if(response == 1){
								window.location = "/manifest" + window.location.search;
							}else{
								$('.recaptchaform').modal({backdrop: 'static', keyboard: false})
							}
							grecaptcha.render('recaptcha', {
								'sitekey' : '6LcCGlIUAAAAAMiTcAOESpiOtmqfDxD_aWgA9dUw',
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
</body>
</html>