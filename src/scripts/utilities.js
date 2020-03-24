/**
 * AlcatrazUtilities JS object.
 *
 * This object contains a number of useful public methods. The methods can be accessed anywhere
 * on the front end using `Alcatraz.Utilities.methodName()`.
 *
 * @since  1.0.0
 */

export const AlcatrazUtilities = (function() {
  const htmlEntityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;",
    "/": "&#x2F;"
  };

  /**
   * Escape the HTML entities in a string by replacing them with their character codes.
   *
   * @since    1.0.0
   *
   * @param    {string}  string  The string to escape.
   *
   * @returns  {string}          The escaped string.
   */
  function escapeHtml(string) {
    return String(string).replace(/[&<>"'\/]/g, s => htmlEntityMap[s]);
  }

  /**
   * Expose public methods.
   */
  return {
    escapeHtml: escapeHtml
  };
})();
