$(window).load(function(){

    $("#video_box").hide();
    $("#photo_box").show();

    $("#upload_switch").click(function() {
        if($("#upload_switch").text() == "Add video url")
        {
            $("#upload_switch").text("Add image");
            $("#video_box").show();
            $("#photo_box").hide();
        }
        else
        {
            $("#upload_switch").text("Add video url");
            $("#video_box").hide();
            $("#photo_box").show();
        }
    });

    $(".edit_gallery").click(function() {

        var $row = $(this).parent().closest("div");
        var $students_ids = $row.find(".students_ids").text();

        var parsed_student_id = JSON.parse($students_ids);

        $('#student_modal_id').val(parsed_student_id).change();
        document.getElementById('gallery_invisible_id').value=$(this).data('id') ;

    });

    $(".edit_video").click(function() {

        var $row = $(this).closest("tr");
        var $students_ids = $row.find(".video_students_ids").text();
        var parsed_student_id = JSON.parse($students_ids);

        $('#student_modal_id').val(parsed_student_id).change();
        document.getElementById('gallery_invisible_id').value=$(this).data('id') ;

    });

});//]]>
