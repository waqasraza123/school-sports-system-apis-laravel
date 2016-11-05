$(window).load(function(){

    $(".edit_video").click(function() {

        var $row = $(this).closest("tr");
        var $students_ids = $row.find(".video_students_ids").text();
        var $rosters_ids = $row.find(".video_rosters_ids").text();
        console.log($students_ids);
        var parsed_student_id = JSON.parse($students_ids);
        var parsed_roster_id = JSON.parse($rosters_ids);

        $('#student_modal_id').val(parsed_student_id).change();
        $('#roster_modal_id').val(parsed_roster_id).change();
        document.getElementById('video_invisible_id').value=$(this).data('id') ;

    });

});//]]>
