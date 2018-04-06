function getMaxHeight(e) {
    var h = 0;
    $(e).each(function (i, el) {
        h = h < $(el).height() ? h = $(el).height() : h;
    });
    return h;
}

function setHeight(Parent, Childs) {
    Parent.each(function (indx, e) {
        if(window.innerWidth >= 768 || e.hasAttribute('data-height-mobile')) {
            $(e).find(Childs).height(getMaxHeight($(e).find(Childs)));
        } else {
            $(e).find(Childs).height('auto');
        }
    });
}

$(document).ready(function () {
    var hParent = $('[data-height-parent]');
    var hChild = '[data-height-child]';

    setHeight(hParent, hChild);

    $(window).resize(function () {
        setHeight(hParent, hChild);
    });
});
