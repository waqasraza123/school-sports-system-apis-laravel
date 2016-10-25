$('document').ready(function () {
    var addRostersBtn = $("#add-rosters-btn");
    addRostersBtn.click(function (event) {
        event.preventDefault();

        var rosterId = $("#rosters_id").val();
        var rosterName = $("#rosters_id :selected").text();
        var rosterNameForId = rosterName.replace(/\s+/g, '_').toLowerCase();

        //load the rosters levels using ajax
        $.ajax({
            'url': '/rosters/load-levels',
            'data': {'id': rosterId, 'name': rosterName},
            'method': 'post',
            dataType: 'json',

            success: function (data) {

                $('<div class="row" id="" style="margin-top: 20px">'+
                    '<div class="col-md-3">'+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    "<label for='position' class = 'control-label'>Position</label>"+
                    "<input type='text' name='position[]' class = 'form-control' required>"+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-md-3">'+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    "<label for='jersey' class = 'control-label'>Jersey</label>"+
                    "<input type='text' name='jersey[]' class = 'form-control' required>"+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-md-3">'+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    "<label for='ros_photo' class = 'control-label'>Photo</label>"+
                    "<input type='file' name='ros_photo[]' class = 'form-control'>"+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-md-3">'+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    "<label for='levels' class = 'control-label'>Roster Levels</label>"+
                    "<select id='"+rosterNameForId+"' class='form-control' name='ros_level[]' required></select>"+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<input type="hidden" value="'+rosterId+'" class="roster_id_js" name="_roster_id[]">'
                ).insertAfter($('#add-rosters-before'))

                $.each(data, function (index, item) {
                    $("#" + rosterNameForId).append('<option value="'+item.id+'" class="form-control">'+item.name+'</option>');
                })
            },
            error: function (error) {
                console.log(error);
            }
        })
    })//add roster ends here

    //delete the roster
    var deleteRoster = $(".delete_student_roster");
    deleteRoster.on('click', deleteRoster, function () {
        var idToDelete = $(this).attr('id');
        $("#"+idToDelete).remove();
    })
})