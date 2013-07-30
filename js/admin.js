
 /*
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of MAGIX CMS.
# MAGIX CMS, The content management system optimized for users
# Copyright (C) 2008 - 2013 magix-cms.com <support@magix-cms.com>
#
# OFFICIAL TEAM :
#
#   * Gerits Aurelien (Author - Developer) <aurelien@magix-cms.com> <contact@aurelien-gerits.be>
#
# Redistributions of files must retain the above copyright notice.
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
# -- END LICENSE BLOCK -----------------------------------

# DISCLAIMER

# Do not edit or add to this file if you wish to upgrade MAGIX CMS to newer
# versions in the future. If you wish to customize MAGIX CMS for your
# needs please refer to http://www.magix-cms.com for more information.
*/
/**
 * Author: Gerits
 Aurelien <aurelien[at]magix-cms[point]com>
 * Copyright: MAGIX CMS
 * Date: 3/07/13
 * Time: 15:53
 * License: Dual licensed under the MIT or GPL Version
 */
var MC_plugins_soundcloud = (function($,undefined){
    //Fonction Private
    function html_product_url(collection,data,contener){
        var tbl = $(document.createElement('table')),
            tbody = $(document.createElement('tbody'));
            tbl.attr("id", "table_plugins_soundcloud")
            .addClass('table table-bordered table-condensed table-hover')
            .append(
                $(document.createElement("thead"))
                    .append(
                        $(document.createElement("tr"))
                        .append(
                            $(document.createElement("th")).append(
                                $(document.createElement("span"))
                                .addClass("icon-key")
                            ),
                            $(document.createElement("th")).append("URL")
                            ,
                            $(document.createElement("th"))
                            .append(
                                $(document.createElement("span"))
                                    .addClass("icon-trash")
                            )
                        )
                    ),
                tbody
            );
        tbl.appendTo(contener);
        if(data === undefined){
            console.log(data);
        }
        if(data !== null){
            $.each(data, function(i,item) {
                var remove = $(document.createElement("td")).append(
                    $(document.createElement("a"))
                        .addClass("delete-sc")
                        .attr("href", "#")
                        .attr("data-delete", item.idsc)
                        .attr("title", Globalize.localize( "remove", collection[1] )+": "+item.url_media_sc)
                        .append(
                            $(document.createElement("span")).addClass("icon-trash")
                        )
                );
                tbody.append(
                    $(document.createElement("tr"))
                        .append(
                            $(document.createElement("td")).append(item.idsc),
                            $(document.createElement("td")).append(item.url_media_sc)
                            ,
                            remove
                        )
                )
            });
        }else{
            tbody.append(
                $(document.createElement("tr"))
                    .append(
                        $(document.createElement("td")).append(
                            $(document.createElement("span")).addClass("icon-minus")
                        ),
                        $(document.createElement("td")).append(
                            $(document.createElement("span")).addClass("icon-minus")
                        ),
                        $(document.createElement("td")).append(
                            $(document.createElement("span")).addClass("icon-minus")
                        )
                    )
            )
        }
    }

    /**
     * Ajout d'une URL dans le produit
     * @param collection
     */
    function addProductURL(collection){
        $("#forms_catalog_plugin_soundcloud_add").validate({
            onsubmit: true,
            event: 'submit',
            rules: {
                url_media_sc: {
                    required: true,
                    minlength: 2,
                    url: true
                }
            },
            submitHandler: function(form) {
                $.nicenotify({
                    ntype: "submit",
                    uri: '/'+collection[0]+'/catalog.php?section=product&getlang='+collection[2]+'&action=edit&edit='+collection[3]+'&plugin=soundcloud',
                    typesend: 'post',
                    idforms: $(form),
                    resetform:true,
                    successParams:function(data){
                        $.nicenotify.initbox(data,{
                            display:true
                        });
                        json_listing_data('list-soundcloud',collection);
                    }
                });
                return false;
            }
        });
    }


    /**
     * Ajoute une URL
     * @param collection
     */
    function add(collection){
        var formsAdd = $("#forms_plugins_soundcloud_add").validate({
            onsubmit: true,
            event: 'submit',
            rules: {
                name_sc_h: {
                    required: true,
                    minlength: 2
                },
                url_media_sc_h: {
                    required: true,
                    minlength: 2,
                    url:true
                }
            },
            submitHandler: function(form) {
                $.nicenotify({
                    ntype: "submit",
                    uri: '/'+collection[0]+'/plugins.php?name=soundcloud&action=add',
                    typesend: 'post',
                    idforms: $(form),
                    resetform:true,
                    successParams:function(data){
                        $.nicenotify.initbox(data,{
                            display:true
                        });
                        $('#forms-add').dialog('close');
                        json_listing_data('list-soundcloud-home',collection);
                    }
                });
                return false;
            }
        });
        $('#open-add').on('click',function(){
            $('#forms-add').dialog({
                modal: true,
                resizable: true,
                width: 350,
                height:'auto',
                minHeight: 210,
                buttons: {
                    'Save': function() {
                        $("#forms_plugins_soundcloud_add").submit();
                    },
                    Cancel: function() {
                        $(this).dialog('close');
                        formsAdd.resetForm();
                    }
                }
            });
            return false;
        });
    }

    function html_home_url(collection,data,contener){
        var tbl = $(document.createElement('table')),
            tbody = $(document.createElement('tbody'));
        tbl.attr("id", "table_plugins_soundcloud")
            .addClass('table table-bordered table-condensed table-hover')
            .append(
                $(document.createElement("thead"))
                    .append(
                        $(document.createElement("tr"))
                            .append(
                                $(document.createElement("th")).append(
                                    $(document.createElement("span"))
                                        .addClass("icon-key")
                                ),
                                $(document.createElement("th")).append(Globalize.localize( "heading", collection[1] )),
                                $(document.createElement("th")).append("URL")
                                ,
                                $(document.createElement("th"))
                                    .append(
                                        $(document.createElement("span"))
                                            .addClass("icon-trash")
                                    )
                            )
                    ),
                tbody
            );
        tbl.appendTo(contener);
        if(data === undefined){
            console.log(data);
        }
        if(data !== null){
            $.each(data, function(i,item) {
                var remove = $(document.createElement("td")).append(
                    $(document.createElement("a"))
                        .addClass("delete-sc")
                        .attr("href", "#")
                        .attr("data-delete", item.idsc_h)
                        .attr("title", Globalize.localize( "remove", collection[1] )+": "+item.url_media_sc_h)
                        .append(
                            $(document.createElement("span")).addClass("icon-trash")
                        )
                );
                tbody.append(
                    $(document.createElement("tr"))
                        .attr("id","order_url_"+item.idsc_h)
                        .append(
                            $(document.createElement("td")).append(item.idsc_h),
                            $(document.createElement("td")).append(item.name_sc_h),
                            $(document.createElement("td")).append(item.url_media_sc_h)
                            ,
                            remove
                        )
                )
            });
            $('#table_plugins_soundcloud > tbody').sortable({
                items: "> tr",
                placeholder: "ui-state-highlight",
                cursor: "move",
                axis: "y",
                update : function() {
                    var serial = $('#table_plugins_soundcloud > tbody').sortable('serialize');
                    $.nicenotify({
                        ntype: "ajax",
                        uri: '/'+collection[0]+'/plugins.php?name=soundcloud&action=list',
                        typesend: 'post',
                        noticedata : serial,
                        successParams:function(data){
                            $.nicenotify.initbox(data,{
                                display:false
                            });
                        }
                    });
                }
            });
            $('#table_plugins_soundcloud > tbody').disableSelection();
        }else{
            tbody.append(
                $(document.createElement("tr"))
                    .append(
                        $(document.createElement("td")).append(
                            $(document.createElement("span")).addClass("icon-minus")
                        ),
                        $(document.createElement("td")).append(
                            $(document.createElement("span")).addClass("icon-minus")
                        ),
                        $(document.createElement("td")).append(
                            $(document.createElement("span")).addClass("icon-minus")
                        ),
                        $(document.createElement("td")).append(
                            $(document.createElement("span")).addClass("icon-minus")
                        )
                    )
            )
        }
    }

    /**
     * Retourne le tableau html suivant l'identifiant
     * @param data
     * @param id
     * @returns {*}
     */
    function html_table_data(collection,data,id){
        var contener = '#'+id;
        switch(id){
            case 'list-soundcloud-home':
                return html_home_url(collection,data,contener);
                break;
            case 'list-soundcloud':
                return html_product_url(collection,data,contener);
                break;
        }
    }

    /**
     * Requête Json pour les données utilisant le formatage de tableau
     * @param id
     * @param collection
     */
    function json_listing_data(id,collection){
        var contener = '#'+id;
        switch(id){
            case 'list-soundcloud':
                var json_url = '/'+collection[0]+'/catalog.php?section=product&getlang='+collection[2]+'&action=edit&edit='+collection[3]+'&plugin=soundcloud&json=list'
                break;
            case 'list-soundcloud-home':
                var json_url = '/'+collection[0]+'/plugins.php?name=soundcloud&action=list&json_list_soundcloud=true';
                break;
        }
        // Requête JSON
        $.nicenotify({
            ntype: "ajax",
            uri: json_url,
            typesend: 'get',
            dataType: 'json',
            beforeParams:function(){
                var loader = $(document.createElement("span")).addClass("loader offset5").append(
                    $(document.createElement("img"))
                        .attr('src','/'+baseadmin+'/template/img/loader/small_loading.gif')
                        .attr('width','20px')
                        .attr('height','20px')
                );
                $(contener).html(loader);
            },
            successParams:function(data){
                $(contener).empty();
                $.nicenotify.initbox(data,{
                    display:false
                });
                html_table_data(collection,data,id);
            }
        });
    }

    /**
     * Suppression de l'URL
     * @param id
     * @param collection
     */
    function remove(id,collection){
        var contener = '#'+id;
        $(document).on('click','.delete-sc',function(event){
            switch(id){
                case 'list-soundcloud':
                    var request_url = '/'+collection[0]+'/catalog.php?section=product&getlang='+collection[2]+'&action=edit&edit='+collection[3]+'&plugin=soundcloud&json=list'
                    break;
                case 'list-soundcloud-home':
                    var request_url = '/'+collection[0]+'/plugins.php?name=soundcloud&action=remove';
                    break;
            }
            event.preventDefault();
            var elem = $(this).data("delete");
            $("#window-dialog:ui-dialog").dialog( "destroy" );
            $('#window-dialog').dialog({
                modal: true,
                resizable: false,
                height:180,
                width:350,
                title: Globalize.localize( "delete_item", collection[1] ),
                buttons: {
                    'Delete': function() {
                        $(this).dialog('close');
                        $.nicenotify({
                            ntype: "ajax",
                            uri: request_url,
                            typesend: 'post',
                            noticedata : {delete_sc:elem},
                            successParams:function(e){
                                $.nicenotify.initbox(e,{
                                    display:false
                                });
                                json_listing_data(id,collection);
                            }
                        });
                    },
                    Cancel: function() {
                        $(this).dialog('close');
                    }
                }
            });
            return false;
        });
    }
    return {
    //Fonction Public
        runProduct : function(baseadmin,iso,getlang,edit){
            var collection = new Array(baseadmin, iso, getlang, edit);
            if($.isArray(collection)){
                json_listing_data('list-soundcloud',collection);
                addProductURL(collection);
                remove('list-soundcloud',collection);
            }else{
                console.log('Collection is not array : runProduct');
            }
        },
        run : function(baseadmin,iso){
            var collection = new Array(baseadmin, iso);
            // Method javascript : if( Object.prototype.toString.call( collection ) === '[object Array]' ) {
            if($.isArray(collection)){
                json_listing_data('list-soundcloud-home',collection);
                remove('list-soundcloud-home',collection);
                add(collection);
            }else{
                console.log('Collection is not array : run');
            }
        }
    };
})(jQuery);