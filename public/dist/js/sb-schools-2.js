$(window).load(function(){

    if(document.getElementById('school_invisible_action') != null)
    {
        if(document.getElementById('school_invisible_action').value == 'add')
        {
            $('#photo').hide();
            $(".form_title").text("Add school");
            $(".submit_school_modal").val("Add school");
            $('#photo').attr('src',"")
        }
        else
        {
            $('#photo').show();
            $(".form_title").text("Edit school");
            $(".submit_game_modal").val("Update school");
        }
    }

    $("#add_new_school").click(function()
    {
        document.getElementById('school_invisible_id').value="";
        document.getElementById('name').value="";
        document.getElementById('short_name').value="" ;
        document.getElementById('mascot_name').value="";
        document.getElementById('bio').value="" ;
        document.getElementById('adress').value="";
        document.getElementById('city').value="" ;
        document.getElementById('state').value="" ;
        document.getElementById('zip').value="" ;
        document.getElementById('phone').value="" ;
        document.getElementById('website').value="" ;
        document.getElementById('facebook').value="" ;
        document.getElementById('instagram').value="" ;
        document.getElementById('youtube').value="" ;
        document.getElementById('vimeo').value="" ;
        document.getElementById('twitter').value="" ;
        document.getElementById('school_invisible_action').value="add" ;
        $('#photo').hide();
        $(".form_title").text("Add school");
        $(".submit_school_modal").val("Add school");
        $('#photo').attr('src',"")
    });

    $(".edit_school").click(function() {

        var $row = $(this).closest("tr");    // Find the row
        var $id = $row.find(".id").text();
        var $name = $row.find(".name").text();
        var $short_name = $row.find(".short_name").text();
        var $mascot_name = $row.find(".mascot_name").text();
        var $bio = $row.find(".bio").text();
        var $adress = $row.find(".adress").text();
        var $city = $row.find(".city").text();
        var $state = $row.find(".state").text();
        var $zip = $row.find(".zip").text();
        var $phone = $row.find(".phone").text();
        var $website = $row.find(".website").text();
        var $facebook = $row.find(".facebook").text();
        var $instagram = $row.find(".instagram").text();
        var $youtube = $row.find(".youtube").text();
        var $vimeo = $row.find(".vimeo").text();
        var $twitter = $row.find(".twitter").text();
        var $src=$row.find(".athletics_logo").text(); //Find the text $('.event').children('img').attr('src'

        $('#photo').attr('src',$src);
        $('#photo').show();
        document.getElementById('school_invisible_id').value=$id;
        document.getElementById('name').value=$name;
        document.getElementById('short_name').value=$short_name ;
        document.getElementById('mascot_name').value=$mascot_name;
        document.getElementById('bio').value=$bio ;
        document.getElementById('adress').value=$adress;
        document.getElementById('city').value=$city ;
        document.getElementById('state').value=$state ;
        document.getElementById('zip').value=$zip ;
        document.getElementById('phone').value=$phone ;
        document.getElementById('website').value=$website ;
        document.getElementById('facebook').value=$facebook ;
        document.getElementById('instagram').value=$instagram ;
        document.getElementById('youtube').value=$youtube ;
        document.getElementById('vimeo').value=$vimeo ;
        document.getElementById('twitter').value=$twitter ;
        document.getElementById('school_invisible_image').value=$src ;
        document.getElementById('school_invisible_action').value="edit" ;
        $(".form_title").text("Edit game");
        $(".form_title").text("Edit school");
        $(".submit_school_modal").val("Edit school");
    });

});//]]>


