
var MasterTemplate = {};
(function () {
    $.fn.nativeTrigger = function(eventName) {
        return this.each(function() {
            var el = $(this).get(0);
            MasterTemplate.Utils.triggerNativeEvent(el, eventName);
        });
    };

    MasterTemplate = {

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
                var loadingIcon = jQuery(".loading");
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
        Template:{
            selectors: {
                columnItemContainer: $("#column-items"),
                columnItemsData: $(".column-items-field"),
                addVirtualColumnButton: $(".show-modal"),
                modal: $("#showTemplateModal"),
                document: $("document"),
                addVirtualColumnForm: "#template-add-virtual-column",
                addColumnToListButton: ".add-column-to-list",
                removeColumnItemButton: ".remove-column-item",
                editColumnItemButton: ".edit-column-item",
                editStyleItemButton: ".edit-style-item",
                count_rowspan: 1,
                column_exists:false,
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
                            foundItem = MasterTemplate.Template.methods.findItemById(childItem, id);
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
                findItemByName: function(item, name){
                    if (item.name == name) {
                        return item;
                    }
                    var found = false;
                    var foundItem;
                    if (item.children) {
                        $.each(item.children, function (index, childItem) {
                            foundItem = MasterTemplate.Template.methods.findItemByName(childItem, name);
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
                getArrayOfChildren(arr, existingChildren) {
                    arr.forEach(o => {
                      existingChildren.push(o.name);
                      o.children && this.getArrayOfChildren(o.children, existingChildren);
                    });
                    return existingChildren;
                },
                findDataExists(arr, name) {
                    arr.forEach(o => {
                        // console.log("Find item: ",o)
                        // console.log("Find name: ",name)
                        // console.log("----------------------")
                        if (o.name == name) {
                            MasterTemplate.Template.selectors.column_exists = true;
                            return MasterTemplate.Template.selectors.column_exists;
                        } 
                        if(o.children){
                            this.findDataExists(o.children, name);
                        }

                    });

                    return MasterTemplate.Template.selectors.column_exists;
                },
                addColumnItem: function (obj) {
                    MasterTemplate.Template.selectors.columnItemContainer.nestable('add', {
                        "id": MasterTemplate.Template.methods.getNewId(MasterTemplate.Template.selectors.columnItemsData.val()),
                        "content":obj.type ? obj.name+' ('+obj.type+')' :obj.name,
                        "name":obj.name,
                        "alias":obj.alias ? obj.alias : "",
                        "type":obj.type ? obj.type:"",
                        "colspan":1,
                        "rowspan":1,
                        "header_bold":"bold",
                        "content_bold":"normal",
                        "header_align_vertical":"middle", //top,middle,bottom
                        "header_align_horizontal":"center", //left,right,center
                        "content_align_vertical":"middle", //top,middle,bottom
                        "content_align_horizontal":"center", //left,right,center


                    });
                    MasterTemplate.Template.methods.checkDepth(MasterTemplate.Template.selectors.columnItemContainer.nestable('serialise'));
                    MasterTemplate.Template.methods.loopItem(MasterTemplate.Template.selectors.columnItemContainer.nestable('serialise'));
                    MasterTemplate.Template.selectors.columnItemsData.val(
                        JSON.stringify(
                            MasterTemplate.Template.selectors.columnItemContainer.nestable('serialise')
                        )
                    ).nativeTrigger('change');
                },
                editColumnItem: function(obj){
                    // console.log("Edit Data :",obj)
                    var newObject = {
                        "id": obj.id,
                        "content":obj.content,
                        "name":obj.name,
                        "alias":obj.alias,
                        "type":obj.type,
                        "colspan":obj.colspan,
                        "rowspan":obj.rowspan,
                        "header_bold":obj.header_bold,
                        "content_bold":obj.content_bold,
                        "header_align_vertical":obj.header_align_vertical,
                        "header_align_horizontal":obj.header_align_horizontal,
                        "content_align_vertical":obj.content_align_vertical,
                        "content_align_horizontal":obj.content_align_horizontal
                    };
                    var columnItems = MasterTemplate.Template.selectors.columnItemContainer.nestable('serialise');
                    var itemData;
                    $.each(columnItems, function (index, item) {
                        itemData = MasterTemplate.Template.methods.findItemById(item, id);
                        if (itemData) {
                            return false;
                        }
                    });
                    if (itemData.children) {
                        newObject.children = itemData.children;
                    }

                    MasterTemplate.Template.selectors.columnItemContainer.nestable('replace', newObject);

                    MasterTemplate.Template.selectors.columnItemsData.val(
                        JSON.stringify(
                            MasterTemplate.Template.selectors.columnItemContainer.nestable('serialise')
                        )
                    ).nativeTrigger('change');
                },
                checkDepth(items){
                    var depth = 1;
                    items.forEach(value => {
                        if(value.children){
                            depth = depth>2 ? depth :2 ;
                            value.children.forEach(child => {
                                if(child.children){
                                    depth = 3;
                                }
                            });
                        }
                    });
                    MasterTemplate.Template.selectors.count_rowspan = depth;
                },
                loopItem(items,parent="root",parent_id=null){
                    var self = this;
                    items.forEach(function (value, i) {
                        if(value.children){
                            
                            if(parent_id){
                                // console.log("Parent :",parent);parent_id
                                // console.log("Parent ID:",parent_id);
                                // console.log("Parent Colspan: ",$('#column-items .dd-list li[data-id="'+parent_id+'"]').data('colspan'))
                                // console.log("Name :",value.name);
                                // console.log("Children Length:",value.children.length);
                                // console.log("---------------------------------------");
                                
                                $('#column-items .dd-list li[data-id="'+value.id+'"]').data('colspan', value.children.length);
                                var temp =  $('#column-items .dd-list li[data-id="'+parent_id+'"]').data('colspan') + $('#column-items .dd-list li[data-id="'+value.id+'"]').data('colspan') - 1;
                                $('#column-items .dd-list li[data-id="'+parent_id+'"]').data('colspan', temp);
                            }else{
                                $('#column-items .dd-list li[data-id="'+value.id+'"]').data('colspan', value.children.length);
                            }

                            self.loopItem(value.children,value.name,value.id);
                        }
                        if(parent == "root" && !value.children){
                            $('#column-items .dd-list li[data-id="'+value.id+'"]').data('rowspan', MasterTemplate.Template.selectors.count_rowspan);
                        }else{
                            $('#column-items .dd-list li[data-id="'+value.id+'"]').data('rowspan',1);
                        }
                        
                    });

                }
            },
            init: function () {
                this.addHandlers();
            },
            addHandlers: function () {
                var context = this;
                var formName = "_add_virtual_column_form";

                this.selectors.columnItemContainer.nestable({
                    callback: function (l, e) {
                        context.methods.checkDepth($(l).nestable('serialise'));
                        context.methods.loopItem($(l).nestable('serialise'));
                        context.selectors.columnItemsData.val(JSON.stringify($(l).nestable('serialise'))).nativeTrigger('change');
                    },
                    json: this.selectors.columnItemsData.val(),
                    includeContent: true,
                    scroll: false,
                    maxDepth: 3,
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
                        html += '<span class="edit-style-item"><i class="fa fa-edit" ></i></span>';
                        item_attrs['data-type'] == 'virtual' ? html += '<span class="remove-column-item"><i class="fa fa-remove" ></i></span>':"";
                        html += '</span></div>';
                        html += children;
                        html += '</' + options.itemNodeName + '>';
            
                        return html;
                    }
                });

                this.selectors.addVirtualColumnButton.click(function () {
                    var title = context.selectors.addVirtualColumnButton.attr("data-header");
                    context.selectors.modal.find(".modal-title").html(title);
                    context.selectors.modal.modal("show");

                    callback = {
                        success: function (request) {
                            if (request.status >= 200 && request.status < 400) {
                                // Success!
                                context.selectors.modal.find(".modal-body").html(request.responseText);
                                $(document).find(context.selectors.addVirtualColumnForm).removeClass("hidden");
                            }
                        },
                        error: function (request) {
                            //Do Something
                        }
                    };
                    MasterTemplate.Utils.ajaxrequest(context.selectors.formUrl + "/" + formName, "get", {}, MasterTemplate.Utils.csrf, callback);
                    
                });

                $(document).on("click", context.selectors.addColumnToListButton, function () {
                    var exists = context.methods.findDataExists(MasterTemplate.Template.selectors.columnItemContainer.nestable('serialise'),$(this).attr("data-name"));
                    // console.log(exists);
                    if(!exists){
                        var dataObj = {
                            id: $(this).attr("data-id"),
                            name: $(this).attr("data-name"),
                            alias: $(this).attr("data-alias")
                        };
                        context.methods.addColumnItem(dataObj);
                    }
                    context.selectors.column_exists = false;
   
                });

                $(document).on("submit", context.selectors.addVirtualColumnForm, function (e) {
                    e.preventDefault();
                    // console.log(e);
                    var formData = $(this).serializeArray().reduce(function (obj, item) {
                        obj[item.name] = item.value;
                        return obj;
                    }, {});

                    if(formData.id == undefined){
                        formData['type'] = 'virtual';
                        // console.log("New :",formData)
                        context.methods.addColumnItem(formData);
                        context.selectors.modal.modal("hide");
                    }else{
                        console.log("Update :",formData)
                        context.methods.editColumnItem(formData);
                        context.selectors.modal.modal("hide");
                    }
        
                });

                $(document).on("click", context.selectors.removeColumnItemButton, function () {
                    context.selectors.columnItemContainer.nestable('remove', $(this).parents(".dd-item").first().attr("data-id"));
                    context.methods.checkDepth(context.selectors.columnItemContainer.nestable('serialise'));
                    context.methods.loopItem(context.selectors.columnItemContainer.nestable('serialise'));
                    context.selectors.columnItemsData.val(
                        JSON.stringify(
                            context.selectors.columnItemContainer.nestable('serialise')
                        )
                    ).nativeTrigger('change');
                });

                $(document).on("click", context.selectors.editStyleItemButton, function () {
                    id = $(this).parents(".dd-item").first().attr("data-id");
                    var columnItems = context.selectors.columnItemContainer.nestable('serialise');
                    var itemData;
                    var formName = "_edit_column_style_form";
                    $.each(columnItems, function (index, item) {
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
                                    if(itemData.alias){
                                        context.selectors.modal.find(".modal-dialog .modal-content .modal-header .modal-title").html("Edit Style Column: "+itemData.alias);
                                    }else{
                                        context.selectors.modal.find(".modal-dialog .modal-content .modal-header .modal-title").html("Edit Style Column: "+itemData.name);
                                    }
       
                                    $(document).find(context.selectors.modal).find(".mi-id").val(itemData.id);
                                    $(document).find(context.selectors.modal).find(".mi-content").val(itemData.content);
                                    $(document).find(context.selectors.modal).find(".mi-name").val(itemData.name);
                                    $(document).find(context.selectors.modal).find(".mi-alias").val(itemData.alias);
                                    $(document).find(context.selectors.modal).find(".mi-type").val(itemData.type);
                                    $(document).find(context.selectors.modal).find(".mi-colspan").val(itemData.colspan);
                                    $(document).find(context.selectors.modal).find(".mi-rowspan").val(itemData.rowspan);
                                    $(document).find(context.selectors.modal).find("#header_align_horizontal").val(itemData.header_align_horizontal);
                                    $(document).find(context.selectors.modal).find("#content_align_horizontal").val(itemData.content_align_horizontal);
                                    $(document).find(context.selectors.modal).find("#header_align_vertical").val(itemData.header_align_vertical);
                                    $(document).find(context.selectors.modal).find("#content_align_vertical").val(itemData.content_align_vertical);
                                    $(document).find(context.selectors.modal).find("#header_bold").val(itemData.header_bold);
                                    $(document).find(context.selectors.modal).find("#content_bold").val(itemData.content_bold);
                                    if(itemData.type == "virtual"){
                                        $(document).find("#content_area").css('display','none');
                                    }
                                    $(document).find(context.selectors.addVirtualColumnForm).removeClass("hidden");
                                    context.selectors.modal.modal("show");
                                }
                            },
                            error: function (request) {
                                //Do Something
                            }
                        };
                        MasterTemplate.Utils.ajaxrequest(context.selectors.formUrl + "/" + formName, "get", {}, MasterTemplate.Utils.csrf, callback);
                    }
                });
            }
        }
    }
})();