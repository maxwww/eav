jQuery(document).ready(function($) {

    optionsChanger();

    $(document).on('change', '#type', function() { optionsChanger(); });

    function optionsChanger() {

        if ($('#type').find(':selected').data('allow-options'))
        {
            $('[data-options]').removeClass('hide');
            $('[data-no-options]').addClass('hide');
        }
        else
        {
            $('[data-options]').addClass('hide');
            $('[data-no-options]').removeClass('hide');
        }

    };

    $(document).on('click', '[data-option-add]', function() {

        var totalRows = $('table tbody tr').length;

        if (totalRows >= 2)
        {
            $('[data-options-empty]').addClass('hide');
        }

        var $tr = $('[data-option-clone]').clone();

        $tr.removeClass('hide').removeAttr('data-option-clone');

        $tr.find('input').each(function()
        {
            $(this).val('').attr('name', $(this).attr('name').replace(/(\d+)/, totalRows + 1)).prop('required', true);
        });

        $('table tbody').append($tr);

    });

    $(document).on('change', '#select_category', function() {

        var catID = $('#select_category').val();

        if (catID != "") {
            var token = $('input[name=_token]').val();
            catID = parseInt(catID);
            $.ajax({type: "POST", url: "/admin/categories/attributes/" + catID, data: {_token: token}, success: function(result){
                $("#params").html(result.html);
            }});
        } else {
            $("#params").html("");
        }

    });

    $(document).on('change', '#image-input', function() {

        $("#image-img").html("");

    });

    $(document).on('click', '[data-option-remove]', function() {

        $(this).closest('tr').remove();

        var totalRows = $('table tbody tr').length;

        if (totalRows === 2)
        {
            $('[data-options-empty]').removeClass('hide');
        }

    });

    $(document).on('click', '[data-add-to-cart]', function(event) {

        var productiD = $( this ).data().addToCart;

        $(".overlay").show();

        setTimeout(function(){
            $.ajax({type: "GET", url: "/api/addtocart/" + productiD, success: function(result){
                $("#cart").html(result.html);
            }});
            $(".overlay").hide();
        }, 1000);
    });

    $(document).on('click', '[data-remove]', function(event) {

        var productiD = $( this ).data().remove;

        $(".overlay").show();

        setTimeout(function(){
            $.ajax({type: "GET", url: "/api/removefromcart/" + productiD, success: function(result){
                $("#bigcart").html(result.html);
                $("#cart").html(result.allCount);
            }});
            $(".overlay").hide();
        }, 1000);
    });

});