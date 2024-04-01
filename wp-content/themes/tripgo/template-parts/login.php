
<style>body{background: #eeee;}</style>
<div id="login-to-view" class="vs-flex vs-just-content-c">
    <div class="vs-flex-60 vs-flex-80 vs-flex-100">
        <div class="vs-bg-color-ffffff vs-b-radius-10 vs-class-login">
            <h2 class="vs-text-align-c vs-pd-top-30 vs-fw-700"><?php esc_html_e( 'Welcome Back', 'woocommerce' ); ?></h2>
            <p class="vs-text-align-c">Please enter your log in credentials</p>
            <form class="woocommerce-form woocommerce-form-login login" method="post">

                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                </p>

                <?php do_action( 'woocommerce_login_form' ); ?>

                <p class="woocommerce-LostPassword lost_password">
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="vs-color-FFA500;"><?php esc_html_e( 'Forgot password?', 'woocommerce' ); ?></a>
                </p>
                <p>
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                </label>
                </p>
                <p class="form-row">
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <button type="submit" class="woocommerce-button button vs-width-100 woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
                </p>
                <p class="vs-text-align-c vs-pd-top-10" >OR</p>
                <p class="vs-text-align-c vs-pd-top-10">Don’t have an account? <a href="javascript:void(0)" onclick="switch_btw_login_signup('registration')">
				    <span class="vs-color-FFA500">Sign up</span></a>
                </p>
                <?php do_action( 'woocommerce_login_form_end' ); ?>

            </form>
        </div>
    </div>
</div>