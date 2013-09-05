<ul class="nav nav-tabs clearfix">
    <li{if !$smarty.get.tab AND $smarty.get.action eq 'list'} class="active"{/if}>
        <a href="{$pluginUrl}&amp;action=list">Accueil</a>
    </li>
    <li{if $smarty.get.tab eq 'about'} class="active"{/if}>
        <a href="{$pluginUrl}&amp;tab=about">About</a>
    </li>
</ul>