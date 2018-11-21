let currentMenu = function(){

    let currentUrl = window.location.pathname;

    if(currentUrl === '/'){
        return false;
    }

    $(function(){

        let links = $('#sidebar').find('ul.components').find('li').children('a');

        $.each(links,function (i,v) {

            let url = v.href;
            let patname = new URL(url).pathname;

            if(patname === currentUrl) {


                let currentRoute = $('a[href*="'+currentUrl+'"]');

                let nivel1 = currentRoute.parents('ul');
                let nivel2 = nivel1.parents('ul');
                let nivel3 = nivel2.parents('ul');
                let niver4 = nivel3.parents('ul');

                let uls = [
                    nivel1,
                    nivel2,
                    nivel3,
                    niver4
                ];

                uls.map(function (dados) {
                    let links = 'a[href*="#'+dados.attr('id')+'"]';
                    $(links).trigger('click');
                });

                return false;
            }
        });
    });
};

currentMenu();