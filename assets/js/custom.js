jQuery(document).ready(function () {
    const mode = getUrlVars()['mode'];
    const darkTheme = localStorage.getItem('dark-theme');
    const themeSwitcher = jQuery('.theme-switcher');
    const logo = jQuery('.logo-image');
    let link = 'light';

    console.log(mode);

    if ((darkTheme && darkTheme === 'enabled') && !mode) {
        jQuery('body').addClass('dark-theme');
        themeSwitcher.children('.feather-sun').show();
        logo.attr('src', logo.data('dark'));
        link = 'dark';
        localStorage.setItem('dark-theme', 'enabled');
    } else if (mode) {
        if (mode === 'dark') {
            jQuery('body').addClass('dark-theme');
            themeSwitcher.children('.feather-sun').show();
            logo.attr('src', logo.data('dark'));
            link = 'dark';
            localStorage.setItem('dark-theme', 'enabled');
        } else {
            themeSwitcher.children('.feather-moon').show();
            logo.attr('src', logo.data('light'));
            localStorage.removeItem('dark-theme');
        }
    } else {
        themeSwitcher.children('.feather-moon').show();
        logo.attr('src', logo.data('light'));
        localStorage.removeItem('dark-theme');
    }

    logo.removeClass('d-none');

    themeSwitcher.on('click', function (e) {
        e.preventDefault();

        const c = localStorage.getItem('dark-theme');

        if (c && c === 'enabled') {
            themeSwitcher.children('.feather-sun').hide();
            themeSwitcher.children('.feather-moon').show();
            jQuery('body').removeClass('dark-theme');
            localStorage.removeItem('dark-theme');
            logo.attr('src', logo.data('light'));
            link = 'light'
        } else {
            themeSwitcher.children('.feather-moon').hide();
            themeSwitcher.children('.feather-sun').show();
            jQuery('body').addClass('dark-theme');
            localStorage.setItem('dark-theme', 'enabled');
            logo.attr('src', logo.data('dark'));
            link = 'dark';
        }
    });

    jQuery('.app-link').on('click', function (e) {
        e.preventDefault();
        const url = jQuery(this).attr('href');
        window.location.href = url + '?mode=' + link;
    });

    function getUrlVars() {
        const vars = [];
        let hash;
        const hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (let i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
});