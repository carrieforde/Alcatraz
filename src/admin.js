import './sass/admin';
/**
 * Alcatraz Admin JS.
 */

(function($) {
  $(document).ready(function() {
    $('#alcatraz-activation-notice .notice-dismiss').on('click', function() {
      var data = {
        action: 'alcatraz_hide_activation_notice'
      };

      $.post(ajaxurl, data, function(response) {
        // Silence is golden.
      });
    });
  });
})(jQuery);
