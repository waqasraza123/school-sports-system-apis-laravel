$(window).load(function(){
    //check if the modal for add/edit is open and if its open repopulate it
    if(document.getElementById('location_invisible_action') != null)
    {
        if(document.getElementById('location_invisible_action').value == 'add')
        {
            $(".form_title").text("Add location");
            $(".submit_location_modal").val("Add location");
        }
        else
        {
            $(".form_title").text("Edit location");
            $(".submit_location_modal").val("Update location");
        }
    }

    $("#add_new_location").click(function()
    {
        document.getElementById('location_invisible_id').value="";
        document.getElementById('name').value="";
        document.getElementById('adress').value="";
        document.getElementById('city').value="" ;
        document.getElementById('state').value="" ;
        document.getElementById('zip').value="" ;
        document.getElementById('lat').value="" ;
        document.getElementById('lon').value="" ;
        document.getElementById('location_invisible_action').value="add" ;
        $(".form_title").text("Add location");
        $(".submit_location_modal").val("Add location");
    });

    $(".edit_location").click(function() {

        var $row = $(this).closest("tr");    // Find the row
        var $id = $row.find(".id").text();
        var $name = $row.find(".name").text();
        var $adress = $row.find(".adress").text();
        var $city = $row.find(".city").text();
        var $state = $row.find(".state").text();
        var $zip = $row.find(".zip").text();
        var $lat = $row.find(".lat").text();
        var $lon = $row.find(".lon").text();

        document.getElementById('location_invisible_id').value=$id;
        document.getElementById('name').value=$name;
        document.getElementById('adress').value=$adress;
        document.getElementById('city').value=$city;
        document.getElementById('state').value=$state ;
        document.getElementById('zip').value=$zip ;
        document.getElementById('lat').value=$lat ;
        document.getElementById('lon').value=$lon ;
        document.getElementById('location_invisible_action').value="edit" ;
        $(".form_title").text("Edit location");
        $(".submit_location_modal").val("Update location");
    });

});//]]>


