{extends file="layout.tpl"}
{block name='body:id'}plugins-{$pluginName}{/block}
{block name="article:content"}
    <h1>{#h1_listing_soundcloud#}</h1>
    {include file="section/tab.tpl"}
    <p class="btn-row">
        <a class="btn btn-primary" href="#" id="open-add">
            <span class="icon-plus"></span> {#add_url#}
        </a>
    </p>
    <div class="mc-message clearfix"></div>
    <div id="list-soundcloud-home"></div>
{/block}
{block name="modal"}
    <div id="window-dialog"></div>
    <div id="forms-add" class="hide-modal" title="Ajouter une URL">
        {include file="forms/add.tpl"}
    </div>
{/block}
{block name='javascript'}
    {include file="js.tpl"}
{/block}