$(function(){
    //console.log("manager home");
    $('a.menuAnch').on('click', function(){
        //console.log($(this).attr('menuId'));
        //console.log($(this).attr('menuUrl'));
        //console.log($('#tabMain').tabs('exists', $(this).text() ));
        if ( $('#tabMain').tabs('exists', $(this).text() ) ) {
            $('#tabMain').tabs('select', $(this).text() );
        } else {
            $('#tabMain').tabs('add',{
                id      : 'content_'+ $(this).attr('menuId'),
                title   : $(this).text(),
                closable: true,
                href    : $(this).attr('menuUrl'),
                cache   : true
            });
        }
    });
});
