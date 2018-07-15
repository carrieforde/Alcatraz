/**
 * Alcatraz Customizer JS.
 */

(function() {
  // Handle live previewing for the site title.
  wp.customize('blogname', value => {
    value.bind(
      to => (document.querySelector('.site-title a').textContent = to)
    );
  });

  // Hides / unhides site title if logo exists.
  wp.customize('custom_logo', setting => {
    setting.bind(logo => {
      const siteTitle = document.querySelector('.site-title');

      if (logo) {
        siteTitle.classList.add('screen-reader-text');
      }

      if (!logo && siteTitle.classList.contains('screen-reader-text')) {
        siteTitle.classList.remove('screen-reader-text');
      }
    });
  });

  // Handle live previewing for the site description.
  wp.customize('blogdescription', value => {
    value.bind(
      to => (document.querySelector('.site-description').textContent = to)
    );
  });

  // Hides / unhides site tagline.
  wp.customize('hide_tagline', setting => {
    setting.bind(hide => {
      const siteTagline = document.querySelector('.site-description');

      if (hide) {
        siteTagline.classList.add('screen-reader-text');
      }

      if (!hide && siteTagline.classList.contains('screen-reader-text')) {
        siteTagline.classList.remove('screen-reader-text');
      }
    });
  });
})();
