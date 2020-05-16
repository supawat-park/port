$.AdminLTE = {};

$.AdminLTE.options = {
    animationSpeed: 500
}

$(function() {
    //Enable sidebar tree view controls
    $.AdminLTE.tree('.sidebar');
});


/* Tree()
* ======
* Converts the sidebar into a multilevel
* tree view menu.
*
* @type Function
* @Usage: $.AdminLTE.tree('.sidebar')
*/
$.AdminLTE.tree = function(menu) {
    var _this = this;
    var animationSpeed = $.AdminLTE.options.animationSpeed;
    $('li a', $(menu)).on('click', function(e) {
    //Get the clicked link and the next element
    var $this = $(this);
    var checkElement = $this.next();

    //Check if the next element is a menu and is visible
    if ((checkElement.is('.treeview-menu')) && (checkElement.is(':visible'))) {
        //Close the menu
        checkElement.slideUp(animationSpeed, function() {
        checkElement.removeClass('menu-open');
        //Fix the layout in case the sidebar stretches over the height of the window
        //_this.layout.fix();
        });
        checkElement.parent('li').removeClass('active');
    }
    //If the menu is not visible
    else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
        //Get the parent menu
        var parent = $this.parents('ul').first();
        //Close all open menus within the parent
        var ul = parent.find('ul:visible').slideUp(animationSpeed);
        //Remove the menu-open class from the parent
        ul.removeClass('menu-open');
        //Get the parent li
        var liParent = $this.parent('li');

        //Open the target menu and add the menu-open class
        checkElement.slideDown(animationSpeed, function() {
        //Add the class active to the parent li
        checkElement.addClass('menu-open');
        parent.find('li.active').removeClass('active');
        liParent.addClass('active');
        //Fix the layout in case the sidebar stretches over the height of the window
        // _this.layout.fix();
        });
    }
    //if this isn't a link, prevent the page from being redirected
    if (checkElement.is('.treeview-menu')) {
        e.preventDefault();
    }
    });
};