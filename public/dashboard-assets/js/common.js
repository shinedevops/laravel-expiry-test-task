$(document).ready(function(){

	/** Form Validation **/
	jQuery.validator.addMethod("emailfull", function(value, element) {
		return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(value);
	}, "Please enter valid email address!");
	$("form.form-validation").each(function(){
		$(this).validate({
			errorElement: 'span',
			errorPlacement: function (error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			}
		});
	});

	/** Reload page when time is complete **/
	if( check_pending_seconds ){
		var current_date = new Date();

		setInterval(function(){ 
			var passed_seconds = ((new Date()).getTime() - current_date.getTime())  / 1000;
			console.log(pending_seconds +  '<' + passed_seconds);
			if( pending_seconds < passed_seconds ){
				location.reload(); 
			} 
		},1000 );
	}
})