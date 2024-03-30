<tr class="tr_rt_resource">
    <td width="13%">
        <input 
            type="text" 
            name="ovabrw_rs_id[]" 
            placeholder="<?php esc_html_e( 'No space', 'ova-brw' ); ?>" 
            autocomplete="off" />
    </td>
    <td width="29%">
        <input 
            type="text" 
            name="ovabrw_rs_name[]" 
            autocomplete="off" />
    </td>
    <td width="15%">
        <input 
            type="text" 
            name="ovabrw_rs_adult_price[]" 
            placeholder="<?php esc_html_e( '10', 'ova-brw' ) ?>" 
            autocomplete="off" />
    </td>
    <td width="15%">
        <input 
            type="text" 
            name="ovabrw_rs_children_price[]" 
            placeholder="<?php esc_html_e( '10', 'ova-brw' ) ?>" 
            autocomplete="off" />
    </td>
     <td width="15%">
        <input 
            type="text" 
            name="ovabrw_rs_baby_price[]" 
            placeholder="<?php esc_html_e( '10', 'ova-brw' ) ?>" 
            autocomplete="off" />
    </td>
    <td width="12%">
        <select name="ovabrw_rs_duration_type[]" class="short_dura">
            <option value="person">
                <?php esc_html_e( '/per person', 'ova-brw' ); ?>
            </option>
            <option value="total">
                <?php esc_html_e( '/total', 'ova-brw' ); ?>
            </option>
        </select>
    </td>
    <td width="1%"><a href="#" class="button delete_resource">x</a></td>
</tr>