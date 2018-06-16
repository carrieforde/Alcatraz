/* eslint-disable camelcase */
/**
 * skip-link-focus-fix.js
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function() {
  var is_webkit = -1 < navigator.userAgent.toLowerCase().indexOf('webkit'),
    is_opera = -1 < navigator.userAgent.toLowerCase().indexOf('opera'),
    is_ie = -1 < navigator.userAgent.toLowerCase().indexOf('msie');

  if (
    (is_webkit || is_opera || is_ie) &&
    document.getElementById &&
    window.addEventListener
  ) {
    window.addEventListener(
      'hashchange',
      function() {
        var id = location.hash.substring(1),
          element;

        if (!/^[A-z0-9_-]+$/.test(id)) {
          return;
        }

        element = document.getElementById(id);

        if (element) {
          if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
            element.tabIndex = -1;
          }

          element.focus();
        }
      },
      false
    );
  }
})();
