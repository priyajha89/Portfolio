<?php 
if ( !isset( $_POST['nonce'] ) || ! wp_verify_nonce( wp_unslash($_POST['nonce']), 'ajax-nonce' ) ) {
    die(esc_html__('Failed security check','profilegrid-user-profiles-groups-and-communities') );
}
$args = array(
    'groups'    => array('filter'    => FILTER_VALIDATE_INT,
                            'flags'     => FILTER_REQUIRE_ARRAY
                           ));
$_POST  = filter_input_array(INPUT_POST,$args);
$gids = implode(',',$_POST['groups']);
$dbhandler = new PM_DBhandler;
$additional = "associate_group in($gids) and field_type not in('file','heading','paragraph','term_checkbox','user_avatar','user_pass','confirm_pass')";
$fields = $dbhandler->get_all_result('FIELDS','*',1,'results',0,false,null,false,$additional);
?>
<div class="uimrow">
    <div class="uimfield">
      <?php esc_html_e( 'Select Field(s):','profilegrid-user-profiles-groups-and-communities' ); ?>
    </div>
    <div class="uiminput pm_select_required">
      <select name="pm_fields[]" id="pm_fields" multiple>
        <?php
        foreach($fields as $field)
        {?>
            <option value="<?php echo esc_attr($field->field_id);?>"><?php echo esc_html($field->field_name); ?></option>
        <?php }
        ?>
      </select>
      <div class="errortext"></div>
    </div>
    <div class="uimnote"><?php esc_html_e('Step 2: Now select the fields you wish to export for each user in above selected Group(s). If you want to export everything, click on a field and press Ctrl+A or ⌘+A to select all of them.','profilegrid-user-profiles-groups-and-communities');?></div>
</div>