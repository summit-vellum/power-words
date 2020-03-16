$('#word').on('keyup', function(){

	var powerWord = $(this),
		pwInfo = $('#help-'+powerWord.attr('id')),
		word = powerWord.val();

	ajaxPartialUpdate('/power-words/validate-word', 'POST', {word:word, id:$('#id').val()}).then(function(response){
		if (!response.success){
			pwInfo.find('.help-validated-check').addClass('hide');
			pwInfo.find('.help-info').addClass('hide');
			pwInfo.find('.help-validated-error').removeClass('hide').css('fill', 'red');
			pwInfo.find('[help-original]').text('Sorry, That title is already taken. Please provide another one.').css('color', 'red');
		} else {
			pwInfo.find('.help-validated-error').addClass('hide');
			pwInfo.find('.help-validated-check').addClass('hide');
			if (word == '') {
				pwInfo.find('.help-info').removeClass('hide');
				pwInfo.find('[help-original]').text(pwInfo.find('[help-original]').attr('help-original')).removeAttr('style');;
			} else {
				pwInfo.find('.help-info').addClass('hide');
				pwInfo.find('.help-validated-check').removeClass('hide').css('fill', 'green');
				pwInfo.find('[help-original]').text('Nice! You have a unique name!').css('color', 'green');;
			}
		}
	});

})

