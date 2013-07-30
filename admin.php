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
 * Date: 3/07/13
 * Time: 13:40
 * License: Dual licensed under the MIT or GPL Version
 */
class plugins_soundcloud_admin extends database_plugins_soundcloud{
    /**
     * Les variables globales
     */
    public $action,$tab,$getlang;
    /**
     * @var url_media
     */
    public $url_media_sc,$url_media_sc_h,$name_sc_h,$delete_sc,$order_url,$edit;
    /**
     * Construct class
     */
    public function __construct(){
        if(magixcjquery_filter_request::isGet('action')){
            $this->action = magixcjquery_form_helpersforms::inputClean($_GET['action']);
        }
        if(magixcjquery_filter_request::isGet('tab')){
            $this->tab = magixcjquery_form_helpersforms::inputClean($_GET['tab']);
        }
        if(magixcjquery_filter_request::isGet('getlang')){
            $this->getlang = (integer) magixcjquery_filter_isVar::isPostNumeric($_GET['getlang']);
        }
        if(magixcjquery_filter_request::isPost('url_media_sc')){
            $this->url_media_sc = magixcjquery_form_helpersforms::inputClean($_POST['url_media_sc']);
        }
        if(magixcjquery_filter_request::isGet('edit')){
            $this->edit = magixcjquery_filter_isVar::isPostNumeric($_GET['edit']);
        }
        if(magixcjquery_filter_request::isPost('delete_sc')){
            $this->delete_sc = (integer) magixcjquery_filter_isVar::isPostNumeric($_POST['delete_sc']);
        }
        if(magixcjquery_filter_request::isPost('name_sc_h')){
            $this->name_sc_h = magixcjquery_form_helpersforms::inputClean($_POST['name_sc_h']);
        }
        if(magixcjquery_filter_request::isPost('url_media_sc_h')){
            $this->url_media_sc_h = magixcjquery_form_helpersforms::inputClean($_POST['url_media_sc_h']);
        }
        if(magixcjquery_filter_request::isPost('order_url')){
            $this->order_url = magixcjquery_form_helpersforms::arrayClean($_POST['order_url']);
        }
    }

    // CATALOG PRODUCT

    /**
     * Suppression d'une URL dans un produit
     */
    private function remove_product(){
        if(isset($this->delete_sc)){
            parent::d_product_url($this->delete_sc);
        }
    }

    /**
     * Execution du plugin dans le catalogue
     * @param $plugin
     * @param $getlang
     * @param $edit
     */
    public function catalog_product($plugin,$getlang,$edit){
        $create = new backend_controller_plugins();
        $header= new magixglobal_model_header();
        $json = new magixglobal_model_json();
        if(isset($this->edit)){
            if(magixcjquery_filter_request::isGet('json')){
                if($_GET['json'] === 'list'){
                    $header->head_expires("Mon, 26 Jul 1997 05:00:00 GMT");
                    $header->head_last_modified(gmdate( "D, d M Y H:i:s" ) . "GMT");
                    $header->pragma();
                    $header->cache_control("nocache");
                    $header->getStatus('200');
                    $header->json_header("UTF-8");
                    if(parent::s_product_url($edit) != null){
                        foreach (parent::s_product_url($edit) as $key){
                            $json_data[]= '{"idsc":'.json_encode($key['idsc']).
                                ',"url_media_sc":'.json_encode($key['url_media_sc']).'}';
                        }
                        $json->encode($json_data,array('[',']'));
                    }
                }
            }else{
                if(isset($this->url_media_sc)){
                    parent::i_product_url($edit,$this->url_media_sc);
                    $create->display('request/success_add.phtml',$plugin);
                }elseif(isset($this->delete_sc)){
                    $this->remove_product();
                }else{
                    $template = $create->fetch('catalog.phtml',$plugin);
                    $javascript = $create->fetch('js.phtml',$plugin);
                    $create->assign('plugin_display',array('template'=>$template,'javascript'=>$javascript));
                    $create->display('catalog/product/edit.phtml');
                }
            }
        }
    }

    /**
     * @access private
     * Installation des tables mysql du plugin
     */
    private function install_table($create){
        if(parent::c_show_table() == 0){
            $create->db_install_table('db.sql', 'request/install.phtml');
        }else{
            $magixfire = new magixcjquery_debug_magixfire();
            $magixfire->magixFireInfo('Les tables mysql sont installés', 'Statut des tables mysql du plugin');
            return true;
        }
    }

    /**
     * Retourne la liste des URL en page d'accueil au format JSON
     */
    private function json_list_soundcloud(){
        $json = new magixglobal_model_json();
        if(parent::s_home_url() != null){
            foreach (parent::s_home_url() as $key){
                $json_data[]= '{"idsc_h":'.json_encode($key['idsc_h']).
                ',"name_sc_h":'.json_encode($key['name_sc_h']).
                ',"url_media_sc_h":'.json_encode($key['url_media_sc_h']).
                '}';
            }
            $json->encode($json_data,array('[',']'));
        }
    }

    private function remove(){
        if(isset($this->delete_sc)){
            parent::d_home_url($this->delete_sc);
        }
    }

    private function add(){
        if(isset($this->name_sc_h) AND isset($this->url_media_sc_h)){
            parent::i_home_url($this->name_sc_h,$this->url_media_sc_h);
        }
    }
    /**
     * Execute Update AJAX FOR order
     * @access private
     *
     */
    private function update_order_url(){
        if(isset($this->order_url)){
            $p = $this->order_url;
            for ($i = 0; $i < count($p); $i++) {
                parent::u_order_url($i,$p[$i]);
            }
        }
    }
    /**
     * Execution du plugin
     */
    public function run(){
        $header= new magixglobal_model_header();
        $create = new backend_controller_plugins();
        if(self::install_table($create) == true){
            if(isset($this->action)){
                if($this->action == 'list'){
                    if(magixcjquery_filter_request::isGet('json_list_soundcloud')){
                        $header->head_expires("Mon, 26 Jul 1997 05:00:00 GMT");
                        $header->head_last_modified(gmdate( "D, d M Y H:i:s" ) . "GMT");
                        $header->pragma();
                        $header->cache_control("nocache");
                        $header->getStatus('200');
                        $header->json_header("UTF-8");
                        $this->json_list_soundcloud();
                    }elseif(isset($this->order_url)){
                        $this->update_order_url();
                    }else{
                        $create->display('list.phtml');
                    }
                }elseif($this->action == 'add'){
                    $this->add($create);
                }elseif($this->action == 'remove'){
                    if(isset($this->delete_sc)){
                        $this->remove();
                    }
                }
            }elseif(isset($this->tab)){
                $create->display('about.phtml');
            }
        }
    }

    /**
     * Set Configuration pour le menu
     * @return array
     */
    public function setConfig(){
        return array(
            'url'=> array(
                'lang'=>'none',
                'action'=>'list'
            ),
            'icon'=> array(
                'type'=>'font',
                'name'=>'icon-cloud'
            )
        );
    }
}
class database_plugins_soundcloud{

    /**
     * Vérifie si les tables du plugin sont installé
     * @access protected
     * return integer
     */
    protected function c_show_table(){
        $table = 'mc_soundcloud';
        return magixglobal_model_db::layerDB()->showTable($table);
    }

    /**
     * @param $edit
     * @return array
     */
    protected function s_product_url($edit){
        $sql = 'SELECT sc.*
        FROM mc_soundcloud AS sc
        WHERE sc.idcatalog = :edit';
        return magixglobal_model_db::layerDB()->select($sql,array(
            ':edit'=>$edit
            )
        );
    }

    /**
     * @access protected
     * @param $idcatalog
     * @param $url_media_sc
     */
    protected function i_product_url($idcatalog,$url_media_sc){
        $sql = 'INSERT INTO mc_soundcloud (idcatalog,url_media_sc)
		VALUE(:idcatalog,:url_media_sc)';
        magixglobal_model_db::layerDB()->insert($sql,
            array(
                ':idcatalog'	=>	$idcatalog,
                ':url_media_sc' =>  $url_media_sc
            )
        );
    }
    /**
     * @access protected
     * @param integer $edit
     */
    protected function d_product_url($edit){
        $sql = 'DELETE FROM mc_soundcloud
        WHERE idsc = :edit';
        magixglobal_model_db::layerDB()->delete($sql,array(
            ':edit'	=>	$edit
        ));
    }

    /**
     * @return array
     */
    protected function s_home_url(){
        $sql = 'SELECT sc.*
        FROM mc_soundcloud_home AS sc
        ORDER BY order_sc_h DESC';
        return magixglobal_model_db::layerDB()->select($sql);
    }

    /**
     * Retourne le nombre maximum d'URL en page d'accueil
     * @return array
     */
    private function s_max_home_order_url(){
        $sql = 'SELECT count(h.idsc_h) porder
    	FROM mc_soundcloud_home AS h';
        return magixglobal_model_db::layerDB()->selectOne($sql);
    }

    /**
     * @param $name_sc_h
     * @param $url_media_sc_h
     */
    protected function i_home_url($name_sc_h,$url_media_sc_h){
        $order_url = $this->s_max_home_order_url();
        $sql = 'INSERT INTO mc_soundcloud_home (name_sc_h,url_media_sc_h,order_sc_h)
		VALUE(:name_sc_h,:url_media_sc_h,:order_url)';
        magixglobal_model_db::layerDB()->insert($sql,
            array(
                ':name_sc_h'	    =>	$name_sc_h,
                ':url_media_sc_h'   =>  $url_media_sc_h,
                ':order_url'		=>	$order_url['porder'] + 1
            )
        );
    }

    /**
     * @access protected
     * @param integer $edit
     */
    protected function d_home_url($edit){
        $sql = 'DELETE FROM mc_soundcloud_home
        WHERE idsc_h = :edit';
        magixglobal_model_db::layerDB()->delete($sql,array(
            ':edit'	=>	$edit
        ));
    }

    /**
     * Met à jour l'ordre d'affichage des URL
     * @param $i
     * @param $id
     */
    protected function u_order_url($i,$id){
        $sql = 'UPDATE mc_soundcloud_home
        SET order_sc_h = :i
        WHERE idsc_h = :id';
        magixglobal_model_db::layerDB()->update($sql,
            array(
                ':i'=>$i,
                ':id'=>$id
            )
        );
    }
}