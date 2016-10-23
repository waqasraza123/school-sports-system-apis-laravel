$(document).ready(function() {
    $("#side-menu li").on("click", function() {
        $("#side-menu li").removeClass("active-menu");
        $(this).addClass("active-menu");
    });

    //add dynamic fields to students form
    $("#add-field").click(function() {
        $("#dynamic-fields-row").append('<div class="col-md-6" id="duplicate">'+
            '<div class="row" style="margin-top: 10px">'+
            '<div class="col-md-5">'+
            '<input type="text" name="custom-field-name[]" class="form-control col-md-3" placeholder="Name">'+
            '</div>'+
            '<div class="col-md-6">'+
            '<input type="text" name="custom-field-value[]" class="form-control col-md-3" placeholder="Value">'+
            '</div>'+
            '<div class="col-md-1"><button type="button" class="btn btn-sm" id="add-new-field">+</button></div>'+
            '</div>'+
            '</div>');
        $("#add-field").attr('disabled', 'disabled')
    });

    var count= 1;

    function incrementCount(){
        return ++count;
    }

    var duplicate = $("#duplicate");
    var newFieldButton = $("#add-new-field");

    $(document).on('click', "#add-new-field", (function () {
        var localCount = incrementCount();
        $("#dynamics-form-outer").append('<div class="row"><div style="margin-top: 10px" class="col-md-6 remove '+localCount+'" data-id-remove="'+localCount+'">'+
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
            '</div>'+
            '</div>'
        ).show('slow');
    }));

    //remove the custom fields
    $(document).on('click', "button.remove-btn", function () {
        var elem = $(this);
        $.each($("div.remove"), function (event) {
            if($(this).attr('data-id-remove') == elem.attr('data-id-remove')){
                var classToMatch = elem.attr('data-id-remove');
                $("div").find($("."+classToMatch)).remove();
            }
        });
    });
});
