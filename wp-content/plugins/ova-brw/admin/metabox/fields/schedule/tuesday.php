<?php
    $time_format = ovabrw_get_time_format();
?>
<tr>
    <td width="19%">
        <input 
            type="text" 
            name="ovabrw_schedule_time[tuesday][]" 
            class="ovabrw_hour_picker" 
            placeholder="<?php echo esc_attr( $time_format ); ?>" 
            autocomplete="off" />
    </td>
    <td width="22%">
        <input 
            type="text" 
            name="ovabrw_schedule_adult_price[tuesday][]" 
            placeholder="<?php esc_html_e( '10', 'ova-brw' ) ?>" 
            autocomplete="off" />
    </td>
    <td width="22%">
        <input 
            type="text" 
            name="ovabrw_schedule_children_price[tuesday][]" 
            placeholder="<?php esc_html_e( '10', 'ova-brw' ) ?>" 
            autocomplete="off" />
    </td>
     <td width="22%">
        <input 
            type="text" 
            name="ovabrw_schedule_baby_price[tuesday][]" 
            placeholder="<?php esc_html_e( '10', 'ova-brw' ) ?>" 
            autocomplete="off" />
    </td>
    <td width="14%">
        <select name="ovabrw_schedule_type[tuesday][]" class="short_dura">
            <option value="person">
                <?php esc_html_e( '/per person', 'ova-brw' ); ?>
            </option>
            <option value="total">
                <?php esc_html_e( '/total', 'ova-brw' ); ?>
            </option>
        </select>
    </td>
    <td width="1%"><a href="#" class="button remove_time">x</a></td>
</tr>