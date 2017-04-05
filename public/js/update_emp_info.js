$('#button_update').on('click',function (event) {
    event.preventDefault();
    var val = $("#update_ava").val();
    if(val != ''){
        $.ajax({
            method: 'POST',
            url: urlSaveAva,
            headers: {'X-CSRF-Token': _token},
            processData: false,
            contentType: false,
            data: new FormData($('#file_upload')[0]),
            success: function (data) {
                // $('#ava').attr('src',data);
                window.location.href = url_emp_page;
            }
        })
    }
});

$('#save-account-info').on('click',function (event) {
    var full_name = $('#full_name').val();
    var email = $('#email').val();
    var new_pass = $('#new_pass').val();
    new_pass = new_pass == "" ? null : new_pass;
    var confirm_pass = $('#confirm_pass').val();
    confirm_pass = new_pass != null ? confirm_pass : null;
    if(new_pass != null){
        $.ajax({
            method: 'POST',
            url: urlChangeAccountInfo_hasPass,
            data: {
                full_name: full_name,
                email: email,
                new_pass: new_pass,
                confirm_pass: confirm_pass,
                _token: _token
            }
        }).done(function (msg) {
            alert('Saved your changes!')
        });
    }
    else {
        event.preventDefault();
        $.ajax({
            method: 'POST',
            url: urlChangeAccountInfo_noPass,
            data: {
                full_name: full_name,
                email: email,
                _token: _token
            }
        }).done(function (msg) {
            alert('Saved your changes!');
        });
    }
});

$('#save-persional-detail').on('click', function (event) {
    event.preventDefault();
    var gender = $('input[name=gender]:checked').val();
    var deparment = $('#department').val();
    var address = $('#address').text();
    var phone = $('#phone').val();
    var skypeId = $('#skypeId').val();

    $.ajax({
        method: 'POST',
        url: urlChangePersionalDetail,
        data: {
            gender: gender,
            department: deparment,
            address: address,
            phone: phone,
            skypeId: skypeId,
            _token: _token
        }
    }).done(function (msg) {
        alert('Saved your changes!');
    });
});