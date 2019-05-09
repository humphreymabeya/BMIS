$().ready(function(){
    $('.modal.printable').on('shown.bs.modal', 
    function(){
        $('.modal-dialog', this).addClass('focused');
        $('body').addClass('modalprinter');

        if($(this).hasClass('autoprint')){
            window.print();
        }
    }).on('hidden.bs.modal' , function(){
        $('.modal-dialog', this).removeClass('focused');
        $('body').removeClass('modalprinter');
    });
});