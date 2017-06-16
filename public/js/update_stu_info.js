$('#save-account-info').on('click',function (event) {
    var full_name = $('#full_name').val();
    var email = $('#email').val();
    var new_pass = $('#new_pass').val();
    new_pass = new_pass == "" ? null : new_pass;
    var confirm_pass = $('#confirm_pass').val();
    confirm_pass = confirm_pass != null ? confirm_pass : null;
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
        }).done(function (data) {
            if(data == 1000)
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
        }).done(function (data) {
            if(data == 1000)
                alert('Saved your changes!')
        });
    }
});

$('#save-personal-detail').on('click', function (event) {
    event.preventDefault();
    var gender = $('input[name=gender]:checked').val();
    var university = $('#university').val();
    var major = $('#major').val();
    var address = $('#address').val();
    var phone = $('#phone').val();
    var skypeId = $('#skypeId').val();
    $.ajax({
        method: 'POST',
        url: urlChangePersionalDetail,
        data: {
            gender: gender,
            university: university,
            major: major,
            address: address,
            phone: phone,
            skype_id: skypeId,
            _token: _token
        }
    }).done(function (data) {
        $('#university').val(data.university);
        $('#major').val(data.major);
        $('#address').val(data.address);
        $('#phone').val(data.phone);
        $('#skypeId').val(data.skype_id);
        alert('Saved your changes!');
    });
});


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
                window.location.href = url_student_page
            }
        })
    }
});