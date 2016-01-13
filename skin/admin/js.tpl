{if $smarty.get.plugin}
    {assign var="plugin" value={$smarty.get.plugin} nocache}
{else}
    {assign var="plugin" value={$pluginName} nocache}
{/if}
{script src="/{baseadmin}/min/?f=plugins/{$plugin}/js/bootstrap-timepicker.min.js,plugins/{$plugin}/js/admin.js" concat={$concat} type="javascript"}
<script type="text/javascript">
    var plugin = "{$plugin}";
    $('#duration').timepicker({
        minuteStep: 1,
        template: 'dropdown',
        appendWidgetTo: 'body',
        showSeconds: true,
        showMeridian: false,
        defaultTime: false
    });
    $(function(){
        if (typeof MC_plugins_soundcloud == "undefined")
        {
            console.log("MC_plugins_soundcloud is not defined");
        }else{
            {if $smarty.get.plugin}
            MC_plugins_soundcloud.runProduct(baseadmin,iso,getlang,edit);
            {else}
            MC_plugins_soundcloud.run(baseadmin,iso);
            {/if}
        }
    });
</script>