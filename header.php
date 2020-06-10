<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="main-header d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-5 col-lg-3 col-xxl-2 d-flex text-lg-left text-center align-content-center">
                <div class="logo">
                    <a href="/" class="router-link-active">
                        <span class="back">
                            <img data-light="<?php bloginfo('template_url'); ?>/assets/img/cryptotask-logo.svg"
                                 data-dark="<?php bloginfo('template_url'); ?>/assets/img/cryptotask-logo--light.svg"
                                 alt="Cryptotask" class="d-none logo-image">
                        </span>
                    </a>
                </div>
            </div>
            <div class="d-none col-lg-7 col-xxl-8 d-lg-flex align-content-center">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => 'top-menu list-unstyled list-inline m-0'));
                ?>
            </div>
            <div class="col-7 col-lg-2 d-flex justify-content-end align-content-center">
                <a href="#" class="theme-switcher d-flex align-items-center mr-3">
                    <i data-feather="sun" style="display:none;"></i>
                    <i data-feather="moon" style="display:none;"></i>
                </a>
                <div class="user-info-widget d-flex align-items-center pr-4">
                    <ul class="list-unstyled mb-0 list-inline">
                        <li class="list-inline-item">
                            <a class="app-link" href="<?php echo cryptotask_get_option('app_url'); ?>">Start</a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown d-lg-none">
                    <button class="btn btn-link p-0 m-0 d-flex align-items-center" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown"
                            data-boundary="window"
                            aria-haspopup="true" aria-expanded="false">
                        <i data-feather="menu"></i>
                    </button>

                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'items_wrap' => '<div id="%1$s" class="dropdown-menu %2$s">%3$s</div>',
                            'walker' => new WP_Bootstrap_Navwalker(),
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>