<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$identifier = 'GROUPS';
$pagenum = filter_input(INPUT_GET, 'pagenum');
$activation_popup_default = filter_input(INPUT_GET, 'pg_activation_popup');
$pagenum = isset($pagenum) ? absint($pagenum) : 1;
$limit = 11; // number of rows in page
$offset = ( $pagenum - 1 ) * $limit;
$totalgroups = $dbhandler->pm_count($identifier);
$groups =  $dbhandler->get_all_result($identifier,'*',1,'results',$offset,$limit,'id','desc');
$num_of_pages = ceil( $totalgroups/$limit);
$pagination = $dbhandler->pm_get_pagination($num_of_pages,$pagenum);
$activation_popup = $dbhandler->get_global_option_value('pg_activation_popup', $activation_popup_default);
$dbhandler->update_global_option_value('pg_activation_popup','0');
?>
<div class="pm_notification"></div>
<div class="pmagic pg-group-manager"> 
  
  <!-----Operationsbar Starts----->
  <form name="pm_manage_groups" id="pm_manage_groups" action="admin.php?page=pm_add_group" method="post">
  <div class="operationsbar">
    <div class="pmtitle">
      <?php esc_html_e('Group Manager','profilegrid-user-profiles-groups-and-communities');?>
    </div>
    <div class="icons"><a href="admin.php?page=pm_settings"> <img src="<?php echo esc_url($path.'images/global-settings.png');?>"></a> </div>
    <div class="nav">
      <ul>
        <li>
            <input type="submit" class="pm_add_new" id="pm_add_new" value="<?php esc_attr_e('Add New','profilegrid-user-profiles-groups-and-communities');?>" />
        </li>
        <li class="pm_action_button"><input type="submit" class="pm_disabled" name="duplicate" id="duplicate" value="<?php esc_attr_e('Duplicate','profilegrid-user-profiles-groups-and-communities');?>" disabled></li>
        <li class="pm_action_button"><input type="submit" class="pm_disabled" name="delete" id="delete" value="<?php esc_attr_e('Delete','profilegrid-user-profiles-groups-and-communities');?>" onclick="return pg_confirm('<?php esc_attr_e('You are going to delete selected groups permanently. This action cannot be undone. Please confirm.','profilegrid-user-profiles-groups-and-communities');?>')" disabled></li>
        <li class="pm_action_button"><a href="https://profilegrid.co/profilegrid-starter-guide" target="_blank"><?php esc_html_e('Starter Guide','profilegrid-user-profiles-groups-and-communities');?><span class="dashicons dashicons-book-alt"></span></a></li>
        <li class="pm_action_button pg-translate-link"><a href="https://profilegrid.co/translate-plugins-profilegrid/" target="_blank"><?php esc_html_e('Translate','profilegrid-user-profiles-groups-and-communities');?><span class="dashicons dashicons-translation"></span></a></li>
      </ul>
    </div>
  </div>
  
  <!-------Contentarea Starts----->
  
  <div class="pmagic-cards">
    <div class="pm-card">
      <div class="pm-new-form">
        <input type="text" name="group_name" id="group_name">
        <div class="errortext" id="group_error" style="display:none;"><?php esc_html_e('This is required field','profilegrid-user-profiles-groups-and-communities');?></div>
        <input type="hidden" name="group_id" id="group_id" value="" />
        <input type="hidden" name="associate_role" id="associate_role" value="subscriber">
        <?php wp_nonce_field('save_pm_add_group'); ?>
        <input type="submit" value="<?php esc_attr_e('Add New Group','profilegrid-user-profiles-groups-and-communities');?>" name="submit_group" id="submit_group" onclick="return check_validation()" />
      </div>
    </div>
    <?php if(!empty($groups)):
    foreach($groups as $group):
	
	$meta_query_array = $pmrequests->pm_get_user_meta_query(array('gid'=>$group->id));
	$date_query = $pmrequests->pm_get_user_date_query(array('gid'=>$group->id));
	$user_query =  $dbhandler->pm_get_all_users_ajax('',$meta_query_array,'',0,3,'DESC','ID');
        $total_users = $user_query->get_total();
        $users = $user_query->get_results();
        
	?>
    <div class="pm-card">
      <div class="cardtitle">
        <input type="checkbox" name="selected[]" value="<?php echo esc_attr($group->id);?>" />
        <a href="admin.php?page=pm_add_group&id=<?php echo esc_attr($group->id);?>"><?php echo esc_html($group->group_name);?></a>    
           
      </div>
      <div class="pm-card-icon"><?php echo wp_kses_post( $pmrequests->pg_get_group_card_icon_link($group->id)); ?></div>  
      
      <div class="pm-last-submission"> <b><?php esc_html_e("Latest members",'profilegrid-user-profiles-groups-and-communities');?></b></div>
      <?php foreach($users as $user):?>
      <div class="pm-last-submission"><a href="admin.php?page=pm_profile_view&id=<?php echo esc_attr($user->ID); ?>"><?php echo wp_kses_post( get_avatar($user->user_email,16,'',false,array('class'=>'pm-user','force_display'=>true)));?> </a><span class="pg-submission-date"> <?php 
      echo wp_kses_post( date_i18n( get_option( 'date_format' ), strtotime($user->user_registered) ). " <span class='pg-submission-time'>". date_i18n( get_option( 'time_format' ), strtotime($user->user_registered) ));?></span></span> </div>
      <?php endforeach;?>
      <?php if($total_users>3):?>
      <div class="pm-last-submission"> <?php esc_html_e('(...)','profilegrid-user-profiles-groups-and-communities');?><a href="admin.php?page=pm_user_manager&gid=<?php echo esc_attr($group->id); ?>"> <?php esc_html_e("and",'profilegrid-user-profiles-groups-and-communities');?> <span class="card-submissions"><?php echo esc_html($total_users-3);?> </span> <?php esc_html_e("more",'profilegrid-user-profiles-groups-and-communities');?> </a> </div>
      <?php endif;?>
      <div class="pm-form-shortcode-row">[profilegrid_register <?php echo esc_html('gid="'.$group->id.'');?>"]</div>
      <div class="pm-form-links">
        <div class="pm-form-row pm-group-setting"><a href="admin.php?page=pm_add_group&id=<?php echo esc_attr($group->id);?>"><?php esc_html_e('Settings','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-form-row pm-group-fields"><a href="admin.php?page=pm_profile_fields&gid=<?php echo esc_attr($group->id);?>"><?php esc_html_e('Fields','profilegrid-user-profiles-groups-and-communities');?></a></div>
      </div>
    </div>
    <?php endforeach;?>
    <?php else: ?>
    <?php esc_html_e( 'You have not created any groups yet. Once you have created a new group, it will appear here.','profilegrid-user-profiles-groups-and-communities' ); ?>
    <?php endif;?>
    
    
  </div>
 <?php echo wp_kses_post($pagination);?>
  
 </form>

</div>

<div class="pg-side-banner">

    <div class="pg-sidebanner-image">
        <img src="<?php echo esc_url($path.'images/pg-logo.png');?>">
        </div>
    
    <div class="pg-side-banner-mg-logo"><img src="<?php echo esc_url($path.'images/mg-logo.png');?>"></div>
    <div class="pg-side-banner-wrap">
            <div class="pg-side-banner-content">
                <div class="pg-side-banner-text"></div>
                <div class="pg-side-banner-help-text">Starter Guide</div>
                <div class="pg-side-banner-text">8 minutes read</div>

                <p>Recommended read for quick and easy setup</p>			
            </div>
       
<div class="pg-side-banner-buttons">
                <div class="pg-side-banner-button">
                    <a target="_blank" href="https://profilegrid.co/profilegrid-starter-guide/">View Starter Guide</a>			
                </div>

          			
            </div>

        </div>
   
</div>

    <div class="pg-uim-notice-wrap pg-groups-alert">
        <div class="pg-uim-notice"><?php esc_html_e('Note: Groups are optional. If you do not wish to create multiple groups, you can use the default group for all user profiles and sign ups.','profilegrid-user-profiles-groups-and-communities');?></div>
         </div>
      
    <?php $pmrequests->pm_five_star_review_banner();?>