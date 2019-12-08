$(function() {
	// Get the form.
	var form = $('#formid');

	// Get the messages div.
	var formMessages = $('#message_envio');
	var load = $('#load');

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		e.preventDefault();

		$(formMessages).text('')
		$(load).show();

		// Serialize the form data.
		var formData = $(form).serialize();

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})
		.done(function(response) {
			$(load).hide();

			// Make sure that the formMessages div has the 'success' class.
			$(formMessages).removeClass('error');
			$(formMessages).addClass('sucesso');

			// Set the message text.
			$(formMessages).text(response);

			// Clear the form.
			$('#contact-form textarea').val('');
			$(formMessages).text('Email enviado com sucesso! Agora é só conferir a sua caixa de entrada.')
			document.querySelector('.input-lg').value = '';
		})
		.fail(function(data) {
			$(load).hide();
			console.log(data);
			// Make sure that the formMessages div has the 'error' class.
			$(formMessages).removeClass('sucesso');
			$(formMessages).addClass('error');

			// Set the message text.
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('Erro ao enviar o email.');
			}
		});
	});

});
