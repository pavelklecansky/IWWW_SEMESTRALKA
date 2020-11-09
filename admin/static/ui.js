(function (window, document) {

    var layout   = document.getElementById('layout'),
        menu     = document.getElementById('menu'),
        menuLink = document.getElementById('menuLink');

    function toggleAll(e) {
        var active = 'active';

        e.preventDefault();
        layout.classList.toggle(active);
        menu.classList.toggle(active);
        menuLink.classList.toggle(active);
    }
    
    function handleEvent(e) {
        if (e.target.id === menuLink.id) {
            return toggleAll(e);
        }
        
        if (menu.className.indexOf('active') !== -1) {
            return toggleAll(e);
        }
    }
    
    document.addEventListener('click', handleEvent);

}(this, this.document));
