jQuery(document).ready(function($)
{
    $('.show-icon-box').click(function( e )
    { 
        $('.overlay-icon-picker').fadeIn();        
        e.preventDefault();
        $('.icons-container').fadeIn();
    });

    $('.fa-close').click(function(){
        $('.overlay-icon-picker').fadeOut();
        $('.icons-container').fadeOut('fast');
    });

    $('.icons-container-inner').find('.fa').click(function(){
        $('.selected-icon').attr('class', 'selected-icon ' + $(this).attr('class') );
        $('.picked-icon').val( $(this).attr('class') );
        $('.overlay-icon-picker').fadeOut();
        $('.icons-container').fadeOut('fast');
    });

    $('#search-icon').keyup(function( e ){
        
        if( $('#search-icon').val() === '' )
        {
            $('.icons-container-inner').find('.fa').css('display','inline-block');
            return;
        }
        
        $('.icons-container-inner').find('.fa').css('display','none');

        $.each( $('.icons-container-inner').find('.fa'), function( index, item) {
            var re = new RegExp( $('#search-icon').val() );
            if( $(this).attr('class').search( re ) > 0 )
                $(this).css('display','inline-block');
        });

        if( $( '#search-icon' ).val() === '' ){
            ('.icons-container').find('.fa').css('display','inline-block');
        }

    });

    $('.picked-icon').keyup(function(){
        if( $(this).val().length > 0 ){
            $(this).siblings('.selected-icon').attr( 'class', 'selected-icon ' + $(this).val() );
        }
    });
});
