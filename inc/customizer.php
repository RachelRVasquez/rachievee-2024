<?php
/**
 * RachieVee 2024 Theme Customizer
 *
 * @package RachieVee_2024
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rachievee_2024_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// get the social sites array
	$social_sites = rachievee_2024_social_array();

	// set a priority used to order the social sites
	$priority = 5;

	// section
	$wp_customize->add_section( 'rachievee_2024_social_media_icons', array(
		'title'       => __( 'Social Media Icons', 'rachievee-2024' ),
		'priority'    => 25,
		'description' => __( 'Add the URL for each of your social profiles.', 'rachievee-2024' )
	) );

	// create a setting and control for each social site
	foreach ( $social_sites as $social_site => $value ) {
		// if email icon
		if ( $social_site == 'email' ) {
			// setting
			$wp_customize->add_setting( $social_site, array(
				'sanitize_callback' => 'rachievee_2024_sanitize_email'
			) );
			// control
			$wp_customize->add_control( $social_site, array(
				'label'    => __( 'Email Address', 'rachievee-2024' ),
				'section'  => 'rachievee_2024_social_media_icons',
				'priority' => $priority
			) );
		} else if ( $social_site == 'phone' ) {
			// setting
			$wp_customize->add_setting( $social_site, array(
				'sanitize_callback' => 'rachievee_2024_sanitize_phone'
			) );
			// control
			$wp_customize->add_control( $social_site, array(
				'label'    => __( 'Phone', 'rachievee-2024' ),
				'section'     => 'rachievee_2024_social_media_icons',
				'priority'    => $priority,
				'type'        => 'text'
			) );
		} else {

			$label = ucfirst( $social_site );

			if ( $social_site == 'rss' ) {
				$label = __('RSS', 'rachievee-2024');
			} elseif ( $social_site == 'codepen' ) {
				$label = __('CodePen', 'rachievee-2024');
			} elseif ( $social_site == 'stack-overflow' ) {
				$label = __('Stack Overflow', 'rachievee-2024');
			} elseif ( $social_site == 'stack-exchange' ) {
				$label = __('Stack Exchange', 'rachievee-2024');
			} elseif ( $social_site == 'email-form' ) {
				$label = __('Contact Form', 'rachievee-2024');
			}

			if ( $social_site == 'skype' ) {
				// setting
				$wp_customize->add_setting( $social_site, array(
					'sanitize_callback' => 'rachievee_2024_sanitize_skype'
				) );
				// control
				$wp_customize->add_control( $social_site, array(
					'type'        => 'url',
					'label'       => $label,
					'description' => sprintf( __( 'Accepts Skype link protocol (<a href="%s" target="_blank">learn more</a>)', 'rachievee-2024' ), 'https://www.competethemes.com/blog/skype-links-wordpress/' ),
					'section'     => 'rachievee_2024_social_media_icons',
					'priority'    => $priority
				) );
			} else {
				// setting
				$wp_customize->add_setting( $social_site, array(
					'sanitize_callback' => 'esc_url_raw'
				) );
				// control
				$wp_customize->add_control( $social_site, array(
					'type'     => 'url',
					'label'    => $label,
					'section'  => 'rachievee_2024_social_media_icons',
					'priority' => $priority
				) );
			}
		}
		// increment the priority for next site
		$priority = $priority + 5;
	}

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'rachievee_2024_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'rachievee_2024_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'rachievee_2024_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function rachievee_2024_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function rachievee_2024_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function rachievee_2024_customize_preview_js() {
	wp_enqueue_script( 'rachievee-2024-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'rachievee_2024_customize_preview_js' );

if (! function_exists('rachievee_2024_social_array')) {
    function rachievee_2024_social_array()
    {
        $social_sites = array(
            'twitter'       => 'rachievee_twitter_profile',
            'facebook'      => 'rachievee_facebook_profile',
            'linkedin'      => 'rachievee_linkedin_profile',
            'youtube'       => 'rachievee_youtube_profile',
            'rss'           => 'rachievee_rss_profile',
            'email'         => 'rachievee_email_profile',
            'phone'			=> 'rachievee_phone_profile',
            'email-form'    => 'rachievee_email_form_profile',
            'codepen'       => 'rachievee_codepen_profile',
            'github'        => 'rachievee_github_profile',
            'medium'        => 'rachievee_medium_profile',
            'ravelry'       => 'rachievee_ravelry_profile',
            'slack'         => 'rachievee_slack_profile',
            'stack-overflow' => 'rachievee_stack_overflow_profile',
            'stack-exchange' => 'rachievee_stack_exchange_profile',
            'wordpress'      => 'rachievee_wordpress_profile',
            'social_icon_custom_1' => 'social_icon_custom_1_profile',
            'social_icon_custom_2' => 'social_icon_custom_2_profile',
            'social_icon_custom_3' => 'social_icon_custom_3_profile'
        );

        return apply_filters('rachievee_2024_social_array_filter', $social_sites);
    }
}

if (! function_exists('rachievee_2024_social_icons_output')) {
    function rachievee_2024_social_icons_output()
    {

        // Get the social icons array
        $social_sites = rachievee_2024_social_array();
        // Store only icons with URLs saved
        $saved = array();

        /* Store the site name and ID if saved
        /* name: twitter
        /* id: rachievee_twitter_profile */
        foreach ($social_sites as $name => $id) {
            if (strlen(get_theme_mod($name)) > 0) {
                $saved[ $name ] = $id;
            }
        }

        // If there are any social profiles saved
        if (!empty($saved)) {
            echo "<nav id='social-navigation' class='social-navigation'><ul class='social-media-icons'>";

            // Output list item for every saved profile
            foreach ($saved as $name => $id) {
                if ($name == 'rss') {
                    $class = 'fas fa-rss';
                } elseif ($name == 'email') {
                    $class = 'fas fa-envelope';
                } elseif ($name == 'email-form') {
                    $class = 'far fa-envelope';
                } elseif ($name == 'podcast') {
                    $class = 'fas fa-podcast';
                } elseif ($name == 'ok-ru') {
                    $class = 'fab fa-odnoklassniki';
                } elseif ($name == 'wechat') {
                    $class = 'fab fa-weixin';
                } elseif ($name == 'pocket') {
                    $class = 'fab fa-get-pocket';
                } elseif ($name == 'phone') {
                    $class = 'fas fa-phone';
                } else {
                    $class = 'fab fa-' . $name;
                }

                $url = get_theme_mod($name);
                $title = $name;

                // Escape the URL based on protocol being used
                if ($name == 'email') {
                    $href = 'mailto:' . antispambot(is_email($url));
                    $title = antispambot(is_email($url));
                } elseif ($name == 'skype') {
                    $href = esc_url($url, array( 'http', 'https', 'skype' ));
                } elseif ($name == 'phone') {
                    $href = esc_url($url, array( 'tel' ));
                    $title = esc_url($url, array( 'tel' ));
                } else {
                    $href = esc_url($url);
                }
                // Output the icon
                if ($name == 'social_icon_custom_1' || $name == 'social_icon_custom_2' || $name == 'social_icon_custom_3') { ?>
					<li>
						<a class="custom-icon" target="_blank" href="<?php echo $href; ?>">
							<img class="icon" src="<?php echo esc_url(get_theme_mod($name .'_image')); ?>" style="width: <?php echo absint(get_theme_mod($name . '_size', '20')); ?>px;" alt="<?php echo esc_html(get_theme_mod($name . '_name'));  ?>" />
						</a>
					</li>
				<?php
                } else { ?>
					<li>
						<a class="<?php echo esc_attr($name); ?>" target="_blank" href="<?php echo $href; ?>">
							<i class="<?php echo esc_attr($class); ?>" aria-hidden="true" title="<?php echo esc_attr($title); ?>"></i>
							<span class="screen-reader-text"><?php echo esc_html($title);  ?></span>
						</a>
					</li>
				<?php
                }
            }
            echo "</ul></nav>";
        }
    }
}
