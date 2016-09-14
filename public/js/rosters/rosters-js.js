$(document).ready(function () {
    $("#add-roster-student").click(function (event) {
        event.preventDefault();
        $("#add-roster-student").prop('disabled', true);
        var formData = $("form#rosters-students").serialize();
        console.log("actual data " + formData);


        $.ajax({
            url: '/rosters/students/add',
            'data': formData,
            'method': 'POST',
            dataType: 'json',
            success: function (data) {
                $(".alert-success").show('slow');
                $(".alert-success").text("Student Added Successfully");
                $(".alert-success").delay(2000).hide('slow');
                $("#add-roster-student").prop('disabled', false);
            },
            error:function (data) {
                $(".alert-error").show('slow');
                $.each(data.responseJSON, function (index, value) {
                    $(".alert").html('<ul>'+value[0]+'</ul>')
                });
                $(".alert-error").delay(2000).hide('slow');
                $("#add-roster-student").prop('disabled', false);

            }
        }
        )
    })
});