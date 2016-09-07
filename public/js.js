$(document).ready(function() {
    $("#side-menu li").on("click", function() {
        $("#side-menu li").removeClass("active-menu");
        $(this).addClass("active-menu");
    });

    //add dynamic fields to students form
    $("#add-field").click(function() {
        $("#dynamic-fields-row").show('slow');
    });

    var count= 1;

    function incrementCount(){
        return ++count;
    }

    var duplicate = $("#duplicate");
    var newFieldButton = $("#add-new-field");

    newFieldButton.click(function () {
        var localCount = incrementCount();

        $("#dynamic-fields-row").append('<div style="margin-top: 10px" class="col-md-6 remove '+localCount+'" data-id-remove="'+localCount+'">'+
            '<div class="row">'+
            '<div class="col-md-5">'+
            ' <input type="text" class="form-control col-md-3" name="custom-field-name[]" placeholder="Name">'+
            '</div>'+
            '<div class="col-md-6">'+
            ' <input type="text" class="form-control col-md-3" name="custom-field-value[]" placeholder="Value">'+
            '</div>'+
            '<div class="col-md-1"><button data-id-remove="'+localCount+'" type="button" class="btn btn-sm remove-btn">-</button></div>'+
            '</div>'+
            '</div>'+
            '</div>'
        ).show('slow');
    });

    $(document).on('click', "button.remove-btn", function () {

        var elem = $(this);
        alert($("div.remove").length);
        $.each($("div.remove"), function (event) {
            if($(this).attr('data-id-remove') == elem.attr('data-id-remove')){
                var classToMatch = elem.attr('data-id-remove');
                $("div").find($("."+classToMatch)).remove();
            }
        });
    });

});
