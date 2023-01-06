jQuery(document).ready(function($) {
    $('.like-btn').on('click', function(e){

        e.preventDefault();
        let postId = $(this).attr('data-id');
        var data = {
            'action': 'my_ajax_handler_likes',
            'postid': postId
          };
        $.ajax({
            url: wpajax.url,
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(response){
                $('.click-feedback').html(response.response);
                if("lcount" in response){
                    $('.dislikes-count').html(response.dcount);
                    $('.likes-count').html(response.lcount);
                }
            },
            error: function(err){
                console.log("Error: " + err);
            },
        })
    });



    $('.dislike-btn').on('click', function(e){

        e.preventDefault();
        let postId = $('.like-btn').attr('data-id');
        var data = {
            'action': 'my_ajax_handler_dislikes',
            'like': '0',
            'postid': postId
          };
        $.ajax({
            url: wpajax.url,
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(response){
                $('.click-feedback').html(response.response);
                if("lcount" in response){
                    $('.dislikes-count').html(response.dcount);
                    $('.likes-count').html(response.lcount);
                }
            },
            error: function(err){
                console.log("Error: " + err);
            },
        })
    });

});