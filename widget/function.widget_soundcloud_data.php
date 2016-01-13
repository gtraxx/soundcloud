<?php
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
 * Author: Gerits Aurelien <aurelien[at]magix-cms[point]com>
 * Copyright: MAGIX CMS
 * Date: 30/07/13
 * Time: 23:25
 * Update : 13/01/2016
 * License: Dual licensed under the MIT or GPL Version
 * Example :
 *
 * ##### Home #####
 *
 * {widget_soundcloud_data type="home"}
    <ul class="unstyled">
    {if $collection_soundcloud != null}
    {foreach $collection_soundcloud as $key}
        <li>
            <h4>
                {$key.name_sc_h}
            </h4>
            <a href="{$key.url_media_sc_h}" class="soundcloud">
                {$key.name_sc_h}
            </a>
        </li>
    {/foreach}
    {/if}
    </ul>
 *
 * ##### product ######
 *
 * {widget_soundcloud_data type="product"}
    {if $collection_soundcloud != null}
    {foreach $collection_soundcloud as $key}
        <p class="contener-sound">
            <a itemprop="audio" class="soundcloud" href="{$key}">
                {$product.name}
            </a>
        </p>
    {/foreach}
    {/if}
 */

function smarty_function_widget_soundcloud_data($params, $template){
    $collection = new database_plugins_soundcloud();
    $type = $params['type'];
    switch($type){
        case 'home':
            if($collection->s_home_url() != null){
                $template->assign('collection_soundcloud',$collection->s_home_url());
            }else{
                $template->assign('collection_soundcloud',NULL);
            }
            break;
        case 'product':
            if(isset($_GET['idproduct'])){
                $idproduct = $_GET['idproduct'];
                if($collection->s_product_url($idproduct) != null){
                    foreach($collection->s_product_url($idproduct) as $value){
                        $id[]  = $value['idsc'];
                        $url[] = $value['url_media_sc'];
                    }
                    $template->assign('collection_soundcloud',array_combine($id,$url));
                }else{
                    $template->assign('collection_soundcloud',NULL);
                }
            }
            break;
    }
}
class database_plugins_soundcloud{
    /**
     * @param $idproduct
     * @return array
     */
    public function s_product_url($idproduct){
        $sql = 'SELECT sc.*
        FROM mc_soundcloud AS sc
        JOIN mc_catalog_product AS p ON ( sc.idcatalog = p.idcatalog )
        WHERE p.idproduct = :idproduct';
        return magixglobal_model_db::layerDB()->select($sql,array(
                ':idproduct'=>$idproduct
            )
        );
    }

    /**
     * @return array
     */
    public function s_home_url(){
        $sql = 'SELECT sc.*
        FROM mc_soundcloud_home AS sc
        ORDER BY sc.order_sc_h DESC';
        return magixglobal_model_db::layerDB()->select($sql);
    }
}
?>