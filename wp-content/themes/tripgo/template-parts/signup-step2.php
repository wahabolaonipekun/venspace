
<style>body{background: #eeee;}</style>
<div id="login-to-view" class="vs-flex vs-just-content-c">
    <div class="vs-flex-60 vs-flex-80 vs-flex-100">
        <div class="vs-bg-color-ffffff vs-b-radius-10 vs-class-login">
            <h2 class="vs-text-align-c vs-pd-top-30 vs-fw-700"><?php esc_html_e( 'Complete your profile', 'woocommerce' ); ?></h2>
            <p class="vs-text-align-c">Book unique spaces directly from local hosts</p>
            <form class="woocommerce-form woocommerce-form-login login" method="post">
                <div class="">
                    <div class="vs-flex">
                        <div class="profile-logo" id="profile-logo"></div>
                        <span class="vs-color-FFA500;">Change profile picture</span>
                    </div>
                    <input name="" type="file">
                </div>
                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="firstname"><?php esc_html_e( 'First Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="firstname" id="firstname" autocomplete="firstname" value="<?php echo ( ! empty( $_POST['firstname'] ) ) ? esc_attr( wp_unslash( $_POST['firstname'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="lastname"><?php esc_html_e( 'Last Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="lastname" id="lastname" autocomplete="lastname" value="<?php echo ( ! empty( $_POST['lastname'] ) ) ? esc_attr( wp_unslash( $_POST['lastname'] ) ) : ''; ?>" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="phone_number"><?php esc_html_e( 'Phone Number', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="phone_no" id="phone-no" autocomplete="phone_number" value="<?php echo ( ! empty( $_POST['phone_no'] ) ) ? esc_attr( wp_unslash( $_POST['phone_no'] ) ) : ''; ?>" />
                </p>

                <?php do_action( 'woocommerce_profile_data' ); ?>
                </p>
                <p class="form-row">
                    <?php wp_nonce_field( 'woocommerce-profile', 'woocommerce-profile-nonce' ); ?>
                    <button type="submit" class="woocommerce-button button vs-width-100 woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="profile" value="<?php esc_attr_e( 'Complete Profile', 'woocommerce' ); ?>"><?php esc_html_e( 'Complete Profile', 'woocommerce' ); ?></button>
                </p>
                <?php do_action( 'woocommerce_profile_form_end' ); ?>

            </form>
        </div>
    </div>
</div>