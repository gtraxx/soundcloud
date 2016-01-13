soundcloud
==========

Plugin soundcloud for [magixcms](http://www.magix-cms.com)
                      
![Plugin Soundcloud Magix CMS](https://cloud.githubusercontent.com/assets/356674/12290737/ac820b96-b9e3-11e5-9451-da2b59571d76.png "Plugin Soundcloud pour Magix CMS")

Licence
------------

<pre>
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is a plugin of Magix CMS.
# Magix CMS, a CMS optimized for SEO
# Copyright (C) 2011 - 2016
# Author and contributor:
# Aurelien Gerits aurelien[at]magix-cms[point]com, contact[at]magix-dev[point]be
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
</pre>

### Installation
 * Décompresser l'archive dans le dossier "plugins" de magix cms
 * Connectez-vous dans l'administration de votre site internet
 * Cliquer sur l'onglet plugins du menu déroulant pour sélectionner soundcloud.
 * Une fois dans le plugin, laisser faire l'auto installation
 * Il ne reste que la configuration du plugin pour correspondre avec vos données.

### SMARTY/JAVASCRIPT ###
Ajouter cette ligne dans javascript.tpl
<pre>
{script src="/min/?f=libjs/jimagine/plugins/jquery.jmSoundCloud.js" concat=$concat type="javascript"}
</pre>
// jmSoundCloud
Ajouter dans global.js cette ligne :
<pre>
$('.soundcloud').jmSoundCloud();
</pre>
#### Ajouter un block pour l'affichage du widget (home)

```smarty
{widget_soundcloud_data type="home"}
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
```

#### Ajouter un block pour l'affichage du widget (product)

```smarty
{widget_soundcloud_data type="product"}
{if $collection_soundcloud != null}
{foreach $collection_soundcloud as $key}
    <p class="contener-sound">
        <a itemprop="audio" class="soundcloud" href="{$key}">
            {$product.name}
        </a>
    </p>
{/foreach}
{/if}
```
