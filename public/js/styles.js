(function(){
    'use strict';

    $(function(){
        $("#fade-in-content").fadeIn(3000);
    });
    
    document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });


    var cmds = document.getElementsByClassName('del');
    var i;

    for (i = 0; i < cmds.length; i++) {
        cmds[i].addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('削除してよろしいですか？')) {
                document.getElementById('form_' + this.dataset.id).submit();
            }
        });
    }
    
    
    
})();