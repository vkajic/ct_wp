<?php $currentLanguage = ICL_LANGUAGE_CODE; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/assets/img/favicon-<?php echo $currentLanguage; ?>.ico"/>
	<?php wp_head(); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $currentLanguage == 'en' ? 'UA-109515146-1' : 'UA-187530-34'; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?php echo $currentLanguage == 'en' ? 'UA-109515146-1' : 'UA-187530-34'; ?>');
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '366101914624114');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=366101914624114&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="main-header d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-5 col-xl-3 col-xxl-2 d-flex text-lg-left text-center align-content-center">
                <div class="logo">
                    <a href="/" class="router-link-active">
                        <span class="back">
	                        <?php if ( $currentLanguage === 'hr' ) : ?>
                                <img data-light="<?php bloginfo( 'template_url' ); ?>/assets/img/powered_by_cryptotask_dnevni.png"
                                     data-dark="<?php bloginfo( 'template_url' ); ?>/assets/img/powered_by_cryptotask_nocni.png"
                                     alt="Freelance.hr" class="d-none logo-image">
	                        <?php else : ?>
                                <img data-light="<?php bloginfo( 'template_url' ); ?>/assets/img/cryptotask-logo.svg"
                                     data-dark="<?php bloginfo( 'template_url' ); ?>/assets/img/cryptotask-logo--light.svg"
                                     alt="Cryptotask" class="d-none logo-image">
	                        <?php endif; ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="d-none col-xl-6 col-xxl-7 d-xl-flex align-content-center px-0">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'main-menu',
					'menu_class'     => 'top-menu list-unstyled list-inline m-0'
				) );
				?>
            </div>
            <div class="col-7 col-xl-3 d-flex justify-content-end align-content-center ml-auto">
                <a href="#" class="theme-switcher d-flex align-items-center">
                    <i data-feather="sun" style="display:none;"></i>
                    <i data-feather="moon" style="display:none;"></i>
                </a>
				<?php $languages = apply_filters( 'wpml_active_languages', null, 'orderby=id&order=desc' ); ?>
                <div class="dropdown px-4 w-auto">
                    <button class="btn btn-link btn-lg dropdown-toggle h-100 border-0 m-0 p-0 d-flex align-items-center"
                            type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                        <span class="small language-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path
          d="M20 18h-1.44a.61.61 0 0 1-.4-.12.81.81 0 0 1-.23-.31L17 15h-5l-1 2.54a.77.77 0 0 1-.22.3.59.59 0 0 1-.4.14H9l4.55-11.47h1.89zm-3.53-4.31L14.89 9.5a11.62 11.62 0 0 1-.39-1.24q-.09.37-.19.69l-.19.56-1.58 4.19zm-6.3-1.58a13.43 13.43 0 0 1-2.91-1.41 11.46 11.46 0 0 0 2.81-5.37H12V4H7.31a4 4 0 0 0-.2-.56C6.87 2.79 6.6 2 6.6 2l-1.47.5s.4.89.6 1.5H0v1.33h2.15A11.23 11.23 0 0 0 5 10.7a17.19 17.19 0 0 1-5 2.1q.56.82.87 1.38a23.28 23.28 0 0 0 5.22-2.51 15.64 15.64 0 0 0 3.56 1.77zM3.63 5.33h4.91a8.11 8.11 0 0 1-2.45 4.45 9.11 9.11 0 0 1-2.46-4.45z"/>
</svg>
      </span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<?php foreach ( $languages as $lang ) : ?>
                            <a class="dropdown-item tst"
                               href="<?php echo $lang['url']; ?>"><?php echo ct_get_language_section($lang['native_name']); ?></a>
						<?php endforeach; ?>
                    </div>
                </div>
                <div class="user-info-widget d-flex align-items-center pr-4">
                    <ul class="list-unstyled mb-0 list-inline">
                        <li class="list-inline-item">
                            <a class="app-link"
                               href="<?php echo cryptotask_get_option( 'app_url_' . ICL_LANGUAGE_CODE ); ?>"><?php _e( 'Start', 'cryptotask' ); ?></a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown mobile-menu-dropdown d-xl-none">
                    <button class="btn btn-link p-0 m-0 d-flex align-items-center" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown"
                            data-boundary="window"
                            aria-haspopup="true" aria-expanded="false">
                        <i data-feather="menu"></i>
                    </button>

					<?php
					wp_nav_menu( array(
						'theme_location' => 'main-menu',
						'items_wrap'     => '<div id="%1$s" class="dropdown-menu %2$s">%3$s</div>',
						'walker'         => new WP_Bootstrap_Navwalker(),
					) );
					?>
                </div>
            </div>
        </div>
    </div>
</header>