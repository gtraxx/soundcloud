{if $smarty.get.plugin}
    {assign var="plugin" value={$smarty.get.plugin} nocache}
{else}
    {assign var="plugin" value={$pluginName} nocache}
{/if}
{headlink rel="stylesheet" href="/{baseadmin}/min/?f=plugins/{$plugin}/css/bootstrap-timepicker.min.css" concat={$concat} media="screen"}