//common functionalities for all the javascript featueres
var Backend = {}; // common variable used in all the files of the backend

(function () {
    $.fn.trigger2 = function(eventName) {
        return this.each(function() {
            var el = $(this).get(0);
            Backend.Utils.triggerNativeEvent(el, eventName);
        });
    };
    
    Backend = {

        Utils: {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            triggerNativeEvent:function (el, eventName){
                if (el.fireEvent) { // < IE9
                    (el.fireEvent('on' + eventName));
                } else {
                    var evt = document.createEvent('Events');
                    evt.initEvent(eventName, true, false);
                    el.dispatchEvent(evt);
                }
            },
            toggleClass: function (element, className) {
                if (element.classList) {
                    element.classList.toggle(className);
                } else {
                    var classes = element.className.split(' ');
                    var existingIndex = classes.indexOf(className);

                    if (existingIndex >= 0)
                        classes.splice(existingIndex, 1);
                    else
                        classes.push(className);

                    element.className = classes.join(' ');
                }
            },
            addClass: function (element, className) {
                if (element.classList)
                    element.classList.add(className);
                else
                    element.className += ' ' + className;
            },
            removeClass: function (el, className) {
                if (el.classList)
                    el.classList.remove(className);
                else
                    el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
            },

            documentReady: function (callback) {
                if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading") {
                    callback();
                } else {
                    document.addEventListener('DOMContentLoaded', callback);
                }
            },

            ajaxrequest: function (url, method, data, csrf, callback) {
                var request = new XMLHttpRequest();
                var loadingIcon = $(".loading");
                if (window.XMLHttpRequest) {
                    // code for modern browsers
                    request = new XMLHttpRequest();
                } else {
                    // code for old IE browsers
                    request = new ActiveXObject("Microsoft.XMLHTTP");
                }
                request.open(method, url, true);

                request.onloadstart = function () {
                    loadingIcon.show();
                };
                request.onloadend = function () {
                    loadingIcon.hide();
                };
                request.setRequestHeader('X-CSRF-TOKEN', csrf);
                request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                if ("post" === method.toLowerCase() || "patch" === method.toLowerCase()) {
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                    data = this.jsontoformdata(data);
                }

                // when request is in the ready state change the details or perform success function
                request.onreadystatechange = function () {
                    if (request.readyState === XMLHttpRequest.DONE) {
                        // Everything is good, the response was received.
                        request.onload = callback.success(request);
                    }
                };
                request.onerror = callback.error;
                request.send(data);
            },

            // This should probably only be used if all JSON elements are strings
            jsontoformdata: function (srcjson) {
                if (typeof srcjson !== "object")
                    if (typeof console !== "undefined") {
                        return null;
                    }
                u = encodeURIComponent;
                var urljson = "";
                var keys = Object.keys(srcjson);
                for (var i = 0; i < keys.length; i++) {
                    urljson += u(keys[i]) + "=" + u(srcjson[keys[i]]);
                    if (i < (keys.length - 1)) urljson += "&";
                }
                return urljson;
            },

        },

        Menu: {
            selectors: {
                menuItemContainer: $("#menu-items"),
                menuItemsData: $(".menu-items-field"),
                addCustomUrlButton: $(".show-modal"),
                modal: $("#showMenuModal"),
                document: $("document"),
                addCustomUrlForm: "#menu-add-custom-url",
                addModuleToMenuButton: ".add-module-to-menu",
                removeMenuItemButton: ".remove-menu-item",
                editMenuItemButton: ".edit-menu-item",
                formUrl: "",
            },

            methods: {
                getNewId: function (str) {
                    var arr = str.match(/"id":[0-9]+/gi);
                    if (arr) {
                        $.each(arr, function (index, item) {
                            arr[index] = parseInt(item.replace('"id":', ''));
                        });
                        return Math.max.apply(Math, arr) + 1;
                    }
                    return 1;
                },

                findItemById: function (item, id) {
                    if (item.id == id) {
                        return item;
                    }
                    var found = false;
                    var foundItem;
                    if (item.children) {
                        $.each(item.children, function (index, childItem) {
                            foundItem = Backend.Menu.methods.findItemById(childItem, id);
                            if (foundItem) {
                                found = true;
                                return false;
                            }
                        });
                    }
                    if (found) {
                        return foundItem;
                    }
                    return null;
                },

                addMenuItem: function (obj) {
                    Backend.Menu.selectors.menuItemContainer.nestable('add', {
                        "id": Backend.Menu.methods.getNewId(Backend.Menu.selectors.menuItemsData.val()),
                        "content": obj.name,
                        "name": obj.name,
                        "url": obj.url,
                        "url_type": obj.url_type,
                        "open_in_new_tab": obj.open_in_new_tab,
                        "icon": obj.icon,
                        "view_permission_id": obj.view_permission_id
                    });
                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                },

                editMenuItem: function (obj) {
                    var newObject = {
                        "id": obj.id,
                        "content": obj.name,
                        "name": obj.name,
                        "url": obj.url,
                        "url_type": obj.url_type,
                        "open_in_new_tab": obj.open_in_new_tab,
                        "icon": obj.icon,
                        "view_permission_id": obj.view_permission_id
                    };
                    var menuItems = Backend.Menu.selectors.menuItemContainer.nestable('serialise');
                    var itemData;
                    $.each(menuItems, function (index, item) {
                        itemData = Backend.Menu.methods.findItemById(item, id);
                        if (itemData) {
                            return false;
                        }
                    });
                    if (itemData.children) {
                        newObject.children = itemData.children;
                    }

                    Backend.Menu.selectors.menuItemContainer.nestable('replace', newObject);

                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                }
            },

            init: function () {
                this.addHandlers();
            },

            addHandlers: function () {
                var context = this;
                var formName = "_add_custom_url_form";
                this.selectors.menuItemContainer.nestable({
                    callback: function (l, e) {
                        context.selectors.menuItemsData.val(JSON.stringify($(l).nestable('serialise')));
                    },
                    json: this.selectors.menuItemsData.val(),
                    includeContent: true,
                    scroll: false,
                    maxDepth: 10,
                    itemRenderer: function(item_attrs, content, children, options, item) {
                        var item_attrs_string = $.map(item_attrs, function(value, key) {
                            return ' ' + key + '="' + value + '"';
                        }).join(' ');
            
                        var html = '<' + options.itemNodeName + item_attrs_string + '>';
                        html += '<' + options.handleNodeName + ' class="' + options.handleClass + '">';
                        html += '</' + options.handleNodeName + '>';
                        html += '<div><' + options.contentNodeName + ' class="' + options.contentClass + '">';
                        html += content;
                        html += '</' + options.contentNodeName + '>';
                        html += '<span class="menu-item-buttons pull-right">';
                        // html += '<span class="edit-menu-item"><i class="fa fa-edit" ></i></span>';
                        html += '<span class="remove-menu-item"><i class="fa fa-remove" ></i></span>';
                        html += '</span></div>';
                        html += children;
                        html += '</' + options.itemNodeName + '>';
            
                        return html;
                    }
                });

                this.selectors.addCustomUrlButton.click(function () {
                    var title = context.selectors.addCustomUrlButton.attr("data-header");
                    context.selectors.modal.find(".modal-title").html(title);
                    context.selectors.modal.modal("show");

                    callback = {
                        success: function (request) {
                            if (request.status >= 200 && request.status < 400) {
                                // Success!
                                context.selectors.modal.find(".modal-body").html(request.responseText);
                                // $(document).find(context.selectors.modal).find(".view-permission-block").remove();
                                $(document).find(context.selectors.addCustomUrlForm).removeClass("hidden");
                            }
                        },
                        error: function (request) {
                            //Do Something
                        }
                    };
                    Backend.Utils.ajaxrequest(context.selectors.formUrl + "/" + formName, "get", {}, Backend.Utils.csrf, callback);
                    
                });

                $(document).on("submit", context.selectors.addCustomUrlForm, function (e) {
                    e.preventDefault();
                    var formData = $(this).serializeArray().reduce(function (obj, item) {
                        obj[item.name] = item.value;
                        return obj;
                    }, {});
                    if (formData.name.length > 0) {
                        if (formData.id.length > 0) {
                            context.methods.editMenuItem(formData);
                        } else {
                            context.methods.addMenuItem(formData);
                        }
                        context.selectors.modal.modal("hide");
                    }
                });

                $(document).on("click", context.selectors.addModuleToMenuButton, function () {
                    var dataObj = {
                        id: $(this).attr("data-id"),
                        name: $(this).attr("data-name"),
                        url: $(this).attr("data-url"),
                        url_type: $(this).attr("data-url_type"),
                        open_in_new_tab: $(this).attr("data-open_in_new_tab"),
                        view_permission_id: $(this).attr("data-view_permission_id"),
                    };
                    context.methods.addMenuItem(dataObj);
                });

                $(document).on("click", context.selectors.removeMenuItemButton, function () {
                    console.log("Click ");
                    context.selectors.menuItemContainer.nestable('remove', $(this).parents(".dd-item").first().attr("data-id"));
                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                });

                $(document).on("click", context.selectors.editMenuItemButton, function () {
                    id = $(this).parents(".dd-item").first().attr("data-id");
                    var menuItems = context.selectors.menuItemContainer.nestable('serialise');
                    var itemData;
                    $.each(menuItems, function (index, item) {
                        itemData = context.methods.findItemById(item, id);
                        if (itemData) {
                            return false;
                        }
                    });
                    if (itemData.id != undefined && itemData.id == id) {
                        callback = {
                            success: function (request) {
                                if (request.status >= 200 && request.status < 400) {
                                    // Success!
                                    context.selectors.modal.find(".modal-body").html(request.responseText);
                                    context.selectors.modal.find(".modal-dialog .modal-content .modal-header .modal-title").html("Edit: " + itemData.name);
                                    $(document).find(context.selectors.modal).find(".mi-id").val(itemData.id);
                                    $(document).find(context.selectors.modal).find(".mi-name").val(itemData.name);
                                    $(document).find(context.selectors.modal).find(".mi-url").val(itemData.url);
                                    $(document).find(context.selectors.modal).find(".mi-url_type_" + itemData.url_type).prop("checked", true);
                                    if (itemData.open_in_new_tab == 1) {
                                        $(document).find(context.selectors.modal).find(".mi-open_in_new_tab").prop("checked", true);
                                    }
                                    $(document).find(context.selectors.modal).find(".mi-icon").val(itemData.icon);
                                    $(document).find(context.selectors.modal).find(".mi-view_permission_id").val(itemData.view_permission_id);
                                    $(document).find("#menu-add-custom-url").removeClass("hidden");
                                    context.selectors.modal.modal("show");
                                }
                            },
                            error: function (request) {
                                //Do Something
                            }
                        };
                        Backend.Utils.ajaxrequest(context.selectors.formUrl + "/" + formName, "get", {}, Backend.Utils.csrf, callback);
                    }
                });
            }
        },

    };

})();