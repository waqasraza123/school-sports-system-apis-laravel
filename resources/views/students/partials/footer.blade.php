<script>
    $('.hide-pro').hide();
    function pro() {

        if($("#pro_free_").val() == 0){
            $('.hide-pro').hide('slow');
        }
        if($("#pro_free_").val() == 1){
            $('.hide-pro').show('slow');
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#roster_id').multiselect();
    });
</script>