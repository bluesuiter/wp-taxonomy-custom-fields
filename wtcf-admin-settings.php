<?php

function settingsForm()
{
    ?>
    <div class="wrap">
        <form name="" class="" action="" method="">
            <div class="">
                <label>Label</label>
                <input type="text" name="field_label" class=""/>
            </div>
            <div class="">
                <label>Field Name:</label>
                <input type="text" name="field_name"/>
            </div>
            <div class="">
                <label>Field Type:</label>
                <select name="field_type">
                    <option value="txt">Text</option>
                    <option value="fil">File</option>
                    <option value="ckb">Checkbox</option>
                    <option value="rdb">Radio Button</option>
                    <option value="drd">Drop Down</option>
                    <option value="tta">Text Area</option>
                </select>
            </div>
            <div class="">
                <label>Field Value:</label>
                <textarea name="field_value"></textarea>
            </div>            
        </form>
    </div>
    <?php
}