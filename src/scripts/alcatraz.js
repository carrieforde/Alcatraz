import { AlcatrazUtilities } from "./utilities";
import { AlcatrazNavigation } from "./navigation";
/**
 * Alcatraz JS object.
 *
 * This file contains the main Alcatraz JS object, which serves as a wrapper and namespace under
 * which all of our other component objects can be accessed.
 *
 * Alcatraz.Utils is an object with utility methods that are useful.
 *
 * Alcatraz.Nav is an object with all methods related to the site navigation.
 *
 * @since  1.0.0
 */

export const Alcatraz = (function() {
  /**
   * Save component objects as properties.
   */
  var Utils = AlcatrazUtilities || false;
  var Nav = AlcatrazNavigation || false;

  /**
   * Expose public methods.
   */
  return {
    Utils: Utils,
    Nav: Nav
  };
})();
