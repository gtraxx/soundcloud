{extends file="catalog/{$smarty.get.section}/edit.tpl"}
{block name="styleSheet" append}
    {include file="css.tpl"}
{/block}
{block name="forms"}
    <form id="forms_catalog_plugin_soundcloud_add" method="post" action="">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="fa fa-link"></span>
                    </span>
                    <input type="text" class="form-control" id="url_media_sc" name="url_media_sc" placeholder="URL SoundCloud" value="" size="50" />
                </div>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration" value="" size="10" />
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">{#send#|ucfirst}</button>
            </div>
        </div>
    </form>
    <div id="list-soundcloud"></div>
{/block}
{block name="javascript"}
    {include file="js.tpl"}
{/block}