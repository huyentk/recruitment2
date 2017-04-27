var id;
$('#accept').on('click',function (event) {
   event.preventDefault();
   id = $(this).closest('tr').attr('id');
   $('#ConfirmModal').modal();
});

$('#reject').on('click',function (event) {
    event.preventDefault();
    id = $(this).closest('tr').attr('id');
    $('#RejectModal').modal();
});

$('#sure').on('click',function (event) {
    $.ajax({
        method:'POST',
        url: urlAccept,
        data: {
            id: id,
            job_id: job_id,
            accept: true,
            _token: _token
        },
        success: function (data) {
            if(data == 1000){
                window.location.href = urlJobDetail;
                $('#ConfirmModal').modal('hide');
            }
            else{
                alert('Error occurs!');
            }
        }
    });
});

$('#sureReject').on('click',function (event) {
    $.ajax({
        method:'POST',
        url: urlReject,
        data: {
            id: id,
            job_id: job_id,
            accept: false,
            _token: _token
        },
        success: function (data) {
            if(data == 1000){
                window.location.href = urlJobDetail;
                $('#RejectModal').modal('hide');
            }
            else{
                alert('Error occurs!');
            }
        }
    });
});