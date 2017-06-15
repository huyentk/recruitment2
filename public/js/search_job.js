$(document).ready(function () {
    var jobs = [];
    $.ajax({
        url: urlGetJobs,
        success: function (data) {
            jobs = data;
        }
    }).done(function () {
        $("#skill_tags").autocomplete({
            source: jobs
        });
    });
});

