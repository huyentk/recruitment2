$(document).ready(function () {
    $('#buttonsend').on('click',function (event) {
        event.preventDefault();
        $('#ConfirmModal').modal();
    });

    $('#sure').on('click',function (event) {
        event.preventDefault();
        var intro = $('#intro').text();
        var full_name = $('#full_name').text();
        if(full_name.length < 5){
            alert('Full name is not valid!');
            return;
        }
        var gender = $('#gender').text();
        if(gender.length < 5){
            alert('Gender is not valid!');
            return;
        }
        var birthday = $('#birthday').text();
        if(birthday.length < 5){
            alert('Birthday is not valid!');
            return;
        }
        var university = $('#university').text();
        if(university.length < 5){
            alert('University is not valid!');
            return;
        }
        var major = $('#major').text();
        if(major.length < 5){
            alert('Major is not valid!');
            return;
        }
        var email = $('#email').text();
        if(email.length < 5){
            alert('Email is not valid!');
            return;
        }
        var phone = $('#phone').text();
        if(phone.length < 12){
            alert('Phone is not valid!');
            return;
        }
        var address = $('#address').text();
        if(address.length < 5){
            alert('Address is not valid!');
            return;
        }
        var skype_id = $('#skype_id').text() == '' ? ' ' : $('#skype_id').text();

        $.ajax({
            method: 'POST',
            url: urlSaveFile,
            headers: {'X-CSRF-Token': _token},
            processData: false,
            contentType: false,
            data: new FormData($('#file_upload')[0]),
            success: function (data) {
                if(data == 1000){
                    $.ajax({
                        method: 'POST',
                        url: urlSendMail,
                        data: {
                            job_id: job_id,
                            intro: intro,
                            full_name: full_name,
                            gender: gender,
                            university: university,
                            major: major,
                            email: email,
                            phone: phone,
                            address: address,
                            skype_id: skype_id,
                            _token: _token
                        },
                        success: function (data) {
                            if(data == 1000){
                                alert('Send email successfully!');
                            }
                            else{
                                alert('Error occurs when send mail!');
                            }
                        }
                    });
                }
                else{
                    alert('Error occurs when send mail!');
                }
            }
        });
    })
});