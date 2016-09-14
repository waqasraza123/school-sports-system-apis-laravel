$(window).load(function(){

    $('#photo').hide();
    $(".form_title").text("Add player");
    $(".submit_roster_modal").val("Add player");
    var $sport_id = $('#sport_id');
    var $position = $("#position");
    //ajax call to generate positions for selected sport
    $sport_id.select2().on('change', function()
    {
        $.ajax({
            url:"/sport/api/"+$sport_id.val(),
            type:'GET',
            success:function(data) {
                $position.empty();
                $.each(data, function(value, key) {
                    $position.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                });
                $position.select2(); //reload the list and select the first option
                $position.val($(".poss").text()).change();
            }
        });
    }).trigger('change');
    //check if the modal for add/edit is open and if its open repopulate it
    if(document.getElementById('invisible_action') != null)
    {
        if(document.getElementById('invisible_action').value == 'edit')
        {
            $(".select_sport").hide();
        }
        else if(document.getElementById('invisible_action').value == 'add')
        {
            var $sport_id = $('#sport_id');
            var $position = $("#position");
            $sport_id.select2().on('change', function()
            {
                $.ajax({
                    url:"/sport/api/"+$sport_id.val(),
                    type:'GET',
                    success:function(data) {
                        $position.empty();
                        $.each(data, function(value, key) {
                            $position.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                        });
                        $position.select2(); //reload the list and select the first option
                        $position.val($(".poss").text()).change();
                    }
                });
            }).trigger('change');

            $('#photo').hide();
            $(".form_title").text("Add player");
            $(".submit_roster_modal").val("Add player");
        }
    }

    $("#add_new").click(function() {
        $('#sport_id').val($(".selected_sport_id").text()).change();
        $('#level_id').val($(".selected_level_id").text()).change();
        var $sport_id = $('#sport_id');
        var $position = $("#position");
        //check if the modal for add/edit is open and if its open repopulate it
        $sport_id.select2().on('change', function()
        {
            $.ajax({
                url:"/sport/api/"+$sport_id.val(),
                type:'GET',
                success:function(data) {
                    $position.empty();
                    $.each(data, function(value, key) {
                        $position.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                    });
                    $position.select2(); //reload the list and select the first option
                    $position.val('').change();
                }
            });
        }).trigger('change');

        document.getElementById('invisible_id').value="";
        document.getElementById('first_name').value="" ;
        document.getElementById('last_name').value="" ;
        document.getElementById('jersey').value="";
        $('#position').val('').change();
        $('#height_feet').val('').change();
        $('#height_inches').val('').change();
        $('#weight').val('').change();
        document.getElementById('hometown').value="" ;
        document.getElementById('verse').value="" ;
        document.getElementById('food').value="" ;
        document.getElementById('years_at_sfc').value="" ;
        document.getElementById('invisible_image').value="" ;
        document.getElementById('invisible_action').value='add' ;
        $('#photo').hide();
        $(".form_title").text("Add player");
        $(".submit_roster_modal").val("Add player");
        $(".select_sport").show();
        $('#photo').attr('src',"");
    });

    $(".use-address").click(function() {
        var $position1 = $("#position");
        //check if the modal for add/edit is open and if its open repopulate it
        $.ajax({
            url:"/sport/api/"+$(".selected_sport_id").text(),
            type:'GET',
            success:function(data) {
                $position1.empty();
                $.each(data, function(value, key) {
                    $position1.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                });
                $position1.select2(); //reload the list and select the first option
                $position1.val($(".position").text()).change();
            }
        });

        var $row = $(this).closest("tr");    // Find the row
        var $first_name = $row.find(".first_name").text();
        var $last_name = $row.find(".last_name").text();
        var $jersey = $row.find(".jersey").text();
        var $position = $row.find(".position").text();
        var $height_feet = $row.find(".height_feet").text();
        var $height_inches = $row.find(".height_inches").text();
        var $weight = $row.find(".weight").text();
        var $hometown = $row.find(".hometown").text();
        var $verse = $row.find(".verse").text();
        var $food = $row.find(".food").text();
        var $level_id = $row.find(".level_id").text();
        var $years_at_sfc = $row.find(".years_at_sfc").text();
        var $src=$row.find("td img").attr('src'); //Find the text $('.event').children('img').attr('src'
        $('#photo').attr('src',$src);
        $('#photo').show();
        document.getElementById('invisible_id').value=$(this).data('id') ;
        document.getElementById('first_name').value=$first_name ;
        document.getElementById('last_name').value=$last_name ;
        document.getElementById('jersey').value=$jersey ;
        $('#position').val($position).change();
        $('#height_feet').val($height_feet).change();
        $('#height_inches').val($height_inches).change();
        $('#weight').val($weight).change();
        $('#level_id').val($level_id).change();
        document.getElementById('hometown').value=$hometown ;
        document.getElementById('verse').value=$verse ;
        document.getElementById('food').value=$food ;
        document.getElementById('years_at_sfc').value=$years_at_sfc ;
        document.getElementById('invisible_image').value=$src ;
        document.getElementById('invisible_action').value='edit';
        $(".form_title").text("Edit player");
        $(".submit_roster_modal").val("Update player");
        $(".select_sport").hide();
        var $position1 = $("#position");
        //check if the modal for add/edit is open and if its open repopulate it
        $.ajax({
            url:"/sport/api/"+$row.find(".sport_id").text(),
            type:'GET',
            success:function(data) {
                $position1.empty();
                $.each(data, function(value, key) {
                    $position1.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                });
                $position1.select2(); //reload the list and select the first option
                $position1.val($position).change();
            }
        });

    });

});//]]>


