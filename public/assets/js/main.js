$(document).ready(function(){

    $("#filter-form").on('submit', function(e){
        e.preventDefault();
        index = 0;
        $.ajax({
            method: "POST",
            url: '/transaction/filter',
            data: $('#filter-form').serialize(),
            success: function(html)
            {
                var result = $(html);
                $('tbody').html(result.find('tbody').html());
            }
        });
    });

});