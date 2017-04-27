var skill_array = [];
$("#select_list").change(function(){
    var skill = $('option:selected',this).text();
    var id_skill = $('option:selected',this).val();
    skill_array.push({
        id: id_skill,
        name: skill
    });
    $('#append_skill').append('<div class="col-md-3">'+
        '<p style="font-size: 18px;"><i class="fa fa-tag fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp;'+
        skill +
        '</p></div>');
});

$('#edit').on('click', function (event) {
    event.preventDefault();

    var job_name = $('#job_name').text();
    $('#job_name').replaceWith('<input style="margin-bottom: 20px; width:550px;" id="job_name" class="form-control" required/>');
    $('#job_name').val(job_name);

    $('#own_skill').hide();
    $('#select_skill').show();

    var job_salary = $('#job_salary').text();
    $('#job_salary').replaceWith('<input style="margin-bottom: 20px;margin-left:10px;width: 150px;" id="job_salary" class="form-control" required/>');
    $('#job_salary').val(job_salary);

    var job_description = $('#job_description').text();
    $('#job_description').replaceWith('<textarea class="paragraph form-control" rows="10" id="job_description" style="resize: vertical;width: 96%" required></textarea>');
    $('#job_description').text(job_description);

    var job_requirement = $('#job_requirement').text();
    $('#job_requirement').replaceWith('<textarea class="paragraph form-control" rows="10" id="job_requirement" style="resize: vertical;width: 96%" required></textarea>');
    $('#job_requirement').text(job_description);

    var job_benefit = $('#job_benefit').text();
    $('#job_benefit').replaceWith('<textarea class="paragraph form-control" rows="10" id="job_benefit" style="resize: vertical;width: 96%" required></textarea>');
    $('#job_benefit').text(job_description);

    $(this).hide(); // hide the clicked button
    $('#save-change').show(); // show the Save change button
});

$('#save-change').on('click',function (event) {
    event.preventDefault();
    // console.log(skill_array);
    var job_name = $('#job_name').val();
    var job_salary = $('#job_salary').val();
    var job_description = $('#job_description').val();
    var job_requirement = $('#job_requirement').val();
    var job_benefit = $('#job_benefit').val();
    $.ajax({
        method: 'POST',
        url: urlUpdateJob,
        data: {
            id: job_id,
            skill_array: skill_array,
            name: job_name,
            salary: job_salary,
            description: job_description,
            requirement: job_requirement,
            benefit: job_benefit,
            _token: _token
        },
        success: function (data) {
            if(data == 1000) alert('Update successfully!');
            else alert('Check if you forget to add skills!');
            window.location.href = urlJobDetail;
        }
    });
});