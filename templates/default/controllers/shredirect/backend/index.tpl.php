<?php $this->addJS('templates/default/js/shredirect.js'); ?>
<form class="shredirect-form-add">
    <input class="input link_from" type="text" name="link_from">
    >>
    <input class="input link_to" type="text" name="link_to">
    <select class="input" name="header">
        <option value="301"><?php echo LANG_SHREDIRECT_PAGE_MOVED; ?></option>
        <option value="410"><?php echo LANG_SHREDIRECT_PAGE_REMOVED; ?></option>
    </select>
    <span class="send"><?PHP echo LANG_SHREDIRECT_ADD; ?></span>
</form>
<p class="shredirect-mess" data-mess="<?php echo LANG_SHREDIRECT_ADD_HINT; ?>"><?php echo LANG_SHREDIRECT_ADD_HINT; ?></p>

<?php $this->renderGrid($this->href_to('list'), $grid); ?>