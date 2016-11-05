$(window).load(function(){

    $(".edit_gallery").click(function() {

        var $row = $(this).parent().closest("div");
        var $students_ids = $row.find(".students_ids").text();

        var parsed_student_id = JSON.parse($students_ids);

        $('#student_modal_id').val(parsed_student_id).change();
        document.getElementById('gallery_invisible_id').value=$(this).data('id') ;

    });

});//]]>
