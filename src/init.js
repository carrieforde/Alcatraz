import { Alcatraz } from './alcatraz';
/**
 * Initialization JS.
 *
 * This file initializes all theme functionality including all things that need to fire when
 * the DOM is ready or when the page is fully loaded.
 *
 * @since  1.0.0
 */

(function() {
  // When the DOM is ready, initialize all the things.
  document.addEventListener(
    'DOMContentLoaded',
    () => Alcatraz.Nav.initSiteNavigation
  );

  // Reset the primary nav when a Customizer partial refresh happens.
  document.addEventListener('customize-preview-menu-refreshed', () =>
    Alcatraz.Nav.initPrimaryNavigation()
  );
})();
