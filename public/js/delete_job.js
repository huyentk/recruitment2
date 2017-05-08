$("#delete").on('click',function (event) {
    event.preventDefault();
    $("#DeleteModal").modal();
});

$("#sureDelete").on('click',function (event) {
   event.preventDefault();
   $.ajax({
       method: 'POST',
       url: urlDeleteJob,
       data:{
           job_id: job_id,
           _token: _token
       },
       success: function (data) {
            if(data == -1000){
                alert('Can not delele this job because any student has been registered!!!');
            }else{
                $('#DeleteModal').modal('hide');
                alert('Delete successfully!!!');
                window.location.href = urlJobManagement;
            }
       }
   });
});