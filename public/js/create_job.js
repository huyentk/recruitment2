var skill_array = [];
$("#select_list").change(function(){
    var skill = $('option:selected',this).text();
    var id_skill = $('option:selected',this).val();
    var found = $.grep(skill_array,function (e) {
        return e.id == id_skill;
    });
    if(found.length == 0){
        skill_array.push({
            id: id_skill,
            name: skill
        });
        $('#append_skill').append('<div class="col-md-3">'+
            '<p style="font-size: 18px;">'+
             skill+'&nbsp;<i class="fa fa-minus-circle fa-lg" id="'+id_skill+'" style="color: #9a5406;" aria-hidden="true" ' +
            'onclick="delete_skill(this.id)"></i>'+
            '</p></div>');
    }
});

$('#create').on('click',function (event) {
    event.preventDefault();
    // console.log(skill_array);
    var job_name = $('#job_name').val();
    var job_salary = $('#job_salary').val();
    var job_description = $('#job_description').val();
    var job_requirement = $('#job_requirement').val();
    var job_benefit = $('#job_benefit').val();
    $.ajax({
        method: 'POST',
        url: urlCreateJob,
        data: {
            skill_array: skill_array,
            name: job_name,
            salary: job_salary,
            description: job_description,
            requirement: job_requirement,
            benefit: job_benefit,
            _token: _token
        },
        success: function (data) {
            if(data == 1000){
                alert('Update successfully!');
                window.location.href = urlListJob;
            }
        }
    });
});

function delete_skill(id) {
    for(var i = 0; i < skill_array.length; i++) {
        if(skill_array[i].id == id) {
            skill_array.splice(i, 1);
            $('#'+id).parent().parent().remove();
            break;
        }
    }
}