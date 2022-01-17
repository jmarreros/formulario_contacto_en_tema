
(function($){


    $('#we-contacto').submit(function(event){
        event.preventDefault();

        let msg = $('#we-contacto .msg');

		$.ajax({
			url : we_vars.ajaxurl,
			type: 'post',
            dataType: 'json',
			data: {
				action : 'dcms_process_form',
                nonce: we_vars.dcmscontact,
				form: $('#we-contacto').serialize(),
			},
			beforeSend: function(){
                msg.removeClass(['msg-success', 'msg-error']);
                msg.addClass('msg-info').text('Enviando...');
			},
			success: function(res){
                msg.removeClass('msg-info').text(res.msg);
                if (res.status === '1'){
                    msg.addClass('msg-success');
                } else {
                    msg.addClass('msg-error');
                }
                console.log(res);
			}
		});

    });



})(jQuery);

