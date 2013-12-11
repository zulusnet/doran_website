<div class="form-group">
    <label for="email" class="col-sm-2 control-label">WYSIHTML5:</label>
    <div class="col-sm-10">
	  <div class="well wysihtml5">

<div id="toolbar" style="display: none;">
    <ul class="sc-toolbar-container">
        <li><a data-wysihtml5-command="bold" title="[SC_FE_EDITOR_BOLD_TITLE]" class="sc-bold"></a></li>
        <li><a data-wysihtml5-command="italic" title="[SC_FE_EDITOR_ITALIC_TITLE]" class="sc-italic"></a></li>
        <li><a data-wysihtml5-command="createLink" title="[SC_FE_EDITOR_INSERT_LINK_TITLE]" class="sc-insert-link"></a></li>
        <li><a data-wysihtml5-command="insertImage" title="[SC_FE_EDITOR_INSERT_IMAGE_TITLE]" class="sc-insert-image"></a></li>
        <li><a id="insertSmileys" onclick="showSmileys();" title="[SC_FE_EDITOR_INSERT_SMILEY_TITLE]" class="sc-insert-smileys"></a></li>
        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" title="[SC_FE_EDITOR_INSERT_H1_TITLE]" class="sc-insert-h1"></a></li>
        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" title="[SC_FE_EDITOR_INSERT_H2_TITLE]" class="sc-insert-h2"></a></li>
        <li><a data-wysihtml5-command="insertUnorderedList" title="[SC_FE_EDITOR_INSERT_UL_TITLE]" class="sc-insert-ul"></a></li>
        <li><a data-wysihtml5-command="insertOrderedList" title="[SC_FE_EDITOR_INSERT_OL_TITLE]" class="sc-insert-ol"></a></li>
        <li><a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red" title="[SC_FE_EDITOR_INSERT_RED_TITLE]" class="sc-insert-red"></a></li>
        <li><a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green" title="[SC_FE_EDITOR_INSERT_GREEN_TITLE]" class="sc-insert-green"></a></li>
        <li><a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue" title="[SC_FE_EDITOR_INSERT_BLUE_TITLE]" class="sc-insert-blue"></a></li>
        <li><a data-wysihtml5-command="undo" title="[SC_FE_EDITOR_UNDO_TITLE]" class="sc-undo"></a></li>
        <li><a data-wysihtml5-command="redo" title="[SC_FE_EDITOR_REDO_TITLE]" class="sc-redo"></a></li>
        <li><a data-wysihtml5-action="change_view" title="[SC_FE_EDITOR_SWITCH_TO_SOURCE_TITLE]" class="sc-switch-to-source"></a></li>
    </ul>
    <div data-wysihtml5-dialog="createLink" class="sc-insert-link-container" style="display: none;">
        <label class="sc-label">[SC_FE_EDITOR_INSERT_LINK_LABEL]</label>
        <label class="sc-label"><input data-wysihtml5-dialog-field="href" value="http://" class="form-control"></label>
        <a data-wysihtml5-dialog-action="save" title="[SC_FE_EDITOR_INSERT_LINK_OK_TITLE]" class="sc-ok"></a>
        <a data-wysihtml5-dialog-action="cancel" title="[SC_FE_EDITOR_INSERT_LINK_CANCEL_TITLE]" class="sc-cancel"></a>
    </div>
    <div data-wysihtml5-dialog="insertImage" style="display: none;">
        <label class="sc-label">[SC_FE_EDITOR_INSERT_IMAGE_LABEL]</label>
        <label class="sc-label"><input data-wysihtml5-dialog-field="src" value="http://" class="form-control"></label>
        <label class="sc-label">
            <select data-wysihtml5-dialog-field="className" class="form-control">
                <option value="">[SC_FE_EDITOR_IMAGE_ALIGN_SELECT_DEFAULT]</option>
                <option value="wysiwyg-float-left">[SC_FE_EDITOR_IMAGE_ALIGN_SELECT_LEFT]</option>
                <option value="wysiwyg-float-right">[SC_FE_EDITOR_IMAGE_ALIGN_SELECT_RIGHT]</option>
            </select>
        </label>
        <a data-wysihtml5-dialog-action="save" title="[SC_FE_EDITOR_INSERT_IMAGE_OK_TITLE]" class="sc-ok"></a>
        <a data-wysihtml5-dialog-action="cancel" title="[SC_FE_EDITOR_INSERT_IMAGE_CANCEL_TITLE]" class="sc-cancel"></a>
    </div>
    <div id="smileys" class="sc-smiley-container" style="display: none;">
        <label class="sc-label">[SC_FE_EDITOR_INSERT_SMILEY_LABEL]</label>
        <ul>
            <li><a href="javascript:addSmiley('smiley.png');" class="sc-smiley-1"> </a></li>
            <li><a href="javascript:addSmiley('smiley-grin.png');" class="sc-smiley-2"> </a></li>
            <li><a href="javascript:addSmiley('smiley-lol.png');" class="sc-smiley-3"> </a></li>
            <li><a href="javascript:addSmiley('smiley-wink.png');" class="sc-smiley-4"></a></li>
            <li><a href="javascript:addSmiley('smiley-cool.png');" class="sc-smiley-5"></a></li>
            <li><a href="javascript:addSmiley('smiley-sad.png');" class="sc-smiley-6"></a></li>
            <li><a href="javascript:addSmiley('smiley-cry.png');" class="sc-smiley-7"></a></li>
            <li><a href="javascript:addSmiley('smiley-confuse.png');" class="sc-smiley-8"></a></li>
            <li><a href="javascript:addSmiley('smiley-eek.png');" class="sc-smiley-9"></a></li>
            <li><a href="javascript:addSmiley('smiley-mad.png');" class="sc-smiley-10"></a></li>
            <li><a href="javascript:addSmiley('smiley-grumpy.png');" class="sc-smiley-11"></a></li>
            <li><a href="javascript:addSmiley('smiley-shock.png');" class="sc-smiley-12"></a></li>
            <li><a href="javascript:addSmiley('smiley-squint.png');" class="sc-smiley-13"></a></li>
            <li><a href="javascript:addSmiley('smiley-roll.png');" class="sc-smiley-14"></a></li>
            <li><a href="javascript:addSmiley('smiley-roll-sweat.png');" class="sc-smiley-15"></a></li>
            <li><a href="javascript:addSmiley('smiley-neutral.png');" class="sc-smiley-16"></a></li>
            <li><a href="javascript:addSmiley('smiley-fat.png');" class="sc-smiley-17"></a></li>
            <li><a href="javascript:addSmiley('smiley-slim.png');" class="sc-smiley-18"></a></li>
            <li><a href="javascript:addSmiley('smiley-kiss.png');" class="sc-smiley-19"></a></li>
            <li><a href="javascript:addSmiley('smiley-red.png');" class="sc-smiley-20"></a></li>
            <li><a href="javascript:addSmiley('smiley-razz.png');" class="sc-smiley-21"></a></li>
            <li><a href="javascript:addSmiley('smiley-curly.png');" class="sc-smiley-22"></a></li>
            <li><a href="javascript:addSmiley('smiley-draw.png');" class="sc-smiley-23"></a></li>
            <li><a href="javascript:addSmiley('smiley-money.png');" class="sc-smiley-24"></a></li>
            <li><a href="javascript:addSmiley('smiley-sweat.png');" class="sc-smiley-25"></a></li>
            <li><a href="javascript:addSmiley('smiley-surprise.png');" class="sc-smiley-26"></a></li>
            <li><a href="javascript:addSmiley('smiley-mr-green.png');" class="sc-smiley-27"></a></li>
            <li><a href="javascript:addSmiley('smiley-kitty.png');" class="sc-smiley-28"></a></li>
            <li><a href="javascript:addSmiley('smiley-glass.png');" class="sc-smiley-29"></a></li>
            <li><a href="javascript:addSmiley('smiley-nerd.png');" class="sc-smiley-30"></a></li>
            <li><a href="javascript:addSmiley('smiley-sleep.png');" class="sc-smiley-31"></a></li>
            <li><a href="javascript:addSmiley('smiley-yell.png');" class="sc-smiley-32"></a></li>
            <li><a href="javascript:addSmiley('smiley-angel.png');" class="sc-smiley-33"></a></li>
            <li><a href="javascript:addSmiley('smiley-evil.png');" class="sc-smiley-34"></a></li>
            <li><a href="javascript:addSmiley('smiley-twist.png');" class="sc-smiley-35"></a></li>
            <li><a href="javascript:addSmiley('smiley-upset.png');" class="sc-smiley-36"></a></li>
            <li><a href="javascript:addSmiley('smiley-zipper.png');" class="sc-smiley-37"></a></li>
            <li><a href="javascript:addSmiley('thumb.png');" class="sc-smiley-38"></a></li>
            <li><a href="javascript:addSmiley('thumb-up.png');" class="sc-smiley-39"></a></li>
        </ul>
    </div>
</div>
</div>
    </div>
  </div>
<script type="text/javascript">
    function showSmileys() {
        if (!$('#smileys').hasClass('on')) {
            $('#smileys').addClass('on');
            $('#smileys').show();
        } else {
            $('#smileys').removeClass('on');
            $('#smileys').hide();
        }
    }
    function addSmiley(smiley) {
        wysihtml5_sc_Editor.composer.commands.exec('insertImage', { src: '[SC_FE_SMILEY_URL]' + smiley, alt: smiley });
    }
</script>