$(document).ready(function () {
    $("#add_sponsor_btn").click(function () {
        var sponsorField = $("#sponsor_name_field")
        if((sponsorField.val()).trim() == ''){
            sponsorField.css('border', '1px solid red').attr('placeholder', 'Sponsor Name is Required');
        }
        else{

            var sponsorSelect = $("#sponsor_select")
            sponsorSelect.append('<option selected value="'+sponsorField.val()+'">'+sponsorField.val()+'</option>')
        }
    })
})