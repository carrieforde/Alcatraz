import { Alcatraz } from './alcatraz';
/**
 * Alcatraz Navigation JS object.
 *
 * This object contains several public methods related to the functionality of the menus.
 * The methods can be accessed anywhere on the front end using `Alcatraz.Nav.methodName()`.
 *
 * Alcatraz.Nav.toggleMobileNav() is a direct method for opening and closing the mobile nav.
 *
 * Alcatraz.Nav.toggleListItem() is a direct method for opening or closing an <li> element in
 * a list toggle.
 *
 * Alcatraz.Nav.initListToggle() is a utility function that can transform any nested <ul>
 * structure into a sliding accordion with toggle icons.
 *
 * Alcatraz.Nav.initSiteNavigation() is a method for initializing all site navigation.
 *
 * Alcatraz.Nav.initPrimaryNavigation() is a method for directly initializing the Primary nav.
 *
 * Alcatraz.Nav.initSubPageNavigation() is a method for directly initializing the Sub Page nav.
 *
 * Alcatraz.Nav.resetNavEventListeners() is a method for setting and resetting the navigation
 * event listeners.
 *
 * @since  1.0.0
 */
export const AlcatrazNavigation = (function($) {
  ('use strict');

  const $body = $('body'),
    $window = $(window),
    toggleText = alcatraz_vars.menu_toggle || '', // eslint-disable-line camelcase
    closeText = alcatraz_vars.menu_close || '', // eslint-disable-line camelcase
    slideDuration = alcatraz_vars.slide_duration || 300; // eslint-disable-line camelcase

  /**
   * Toggle a 'focus' class on list items when using keyboard navigation.
   *
   * @since  1.0.0
   *
   * @param  {object}  event  The focus or blur event.
   */
  const _toggleListFocus = function(event) {
    const $this = $(this),
      $item = $this.parent('li');

    if ('focus' === event.type) {
      $item.addClass('focus');
    }

    if ('blur' === event.type) {
      $item.removeClass('focus');
    }
  };

  /**
   * Trigger the toggleListItem function when the toggleListItem event fires.
   *
   * @since  1.0.0
   *
   * @param  {object}  event  The toggleListItem event.
   * @param  {object}  data   The event data.
   */
  const _toggleListItem = function(event, data) {
    const item = data.item || {},
      args = data.args || {};

    toggleListItem(item, args);
  };

  /**
   * Handle keyboard navigation support via tab and arrow keys across all site navigation.
   *
   * @since  1.0.0
   *
   * @param  {object}  event  The keyup event object.
   */
  const _toggleNavItemWithKeyboard = function(event) {
    const code = event.keyCode ? event.keyCode : event.which,
      $el = $(document.activeElement);

    // Bail if a modified key has been pressed.
    if (event.altKey || event.ctrlKey) {
      return true;
    }

    // Bail if we don't have focus on a nav.
    if (!$el.is('nav a:focus')) {
      return true;
    }

    // Get the '<li>' element.
    let $item = $el.parent(),
      $list = $item.parent(),
      $target;

    // Build args for the toggleListItem event.
    const args = { autoClose: true, duration: slideDuration },
      closeArgs = { autoClose: false, duration: slideDuration },
      data = { item: $item, args: args };

    switch (code) {
      case 9: // Tab key.
        if ('keydown' === event.type) {
          return true;
        }

        if ($item.children('ul').length && $list.hasClass('top-level')) {
          // The focused nav item has children and is on the top level, so toggle it.
          $window.trigger('toggleListItem.alcatraz', data);
        } else if ($list.hasClass('top-level')) {
          // The focused nav item doesn't have children and is on the top level, so
          // close any previously toggled top level list items.
          $list.children('li.toggled').each(function() {
            const closeData = {
              item: $(this),
              args: closeArgs
            };
            $window.trigger('toggleListItem.alcatraz', closeData);
          });
        }

        break;

      case 32: // Spacebar.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if ($item.children('ul').length) {
          $window.trigger('toggleListItem.alcatraz', data);
        }

        break;

      case 37: // Left arrow key.
        // Prevent window scrolling.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if ($list.hasClass('top-level') && $item.prev('li').length) {
          // The focused nav item is on the top level and has a sibling before it,
          // so move focus to the left one item.
          $target = $item.prev('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target
            .find('a')
            .first()
            .focus();
        } else if (
          $list
            .parent('li')
            .parent('ul')
            .hasClass('top-level')
        ) {
          // The focused nav item is on a second level sub level, so move focus up
          // one level to the sibling to the left of the parent item.
          $target = $list.parent('li').prev('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target
            .find('a')
            .first()
            .focus();
        } else if (!$list.hasClass('top-level')) {
          // The focused nav item is on a third level sub level or deeper, so move
          // focus up one level and toggle the parent item.
          $target = $list.parent('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target
            .find('a')
            .first()
            .focus();
        }

        break;

      case 38: // Up arrow key.
        // Prevent window scrolling.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if (!$list.hasClass('top-level') && !$item.prev('li').length) {
          // The focused nav item is on a sub level but lacks a sibling before it,
          // so move focus up one item.
          $list
            .parent('li')
            .find('a')
            .first()
            .focus();
        } else if (!$list.hasClass('top-level') && $item.prev('li').length) {
          // The focused nav item is on a sub level and has a sibling before it,
          // so move focus up one item.
          $item
            .prev('li')
            .find('a')
            .first()
            .focus();
        }

        break;

      case 39: // Right arrow key.
        // Prevent window scrolling.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if ($list.hasClass('top-level') && $item.next('li').length) {
          // The focused hav item is on the top level and has a sibling after it,
          // so move focus to the right one item.
          $target = $item.next('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target
            .find('a')
            .first()
            .focus();
        } else if (
          !$list.hasClass('top-level') &&
          $item.children('ul').length
        ) {
          // The focused nav item is on a sub level and has children, so toggle it if
          // it isn't toggled already.
          if (!$item.hasClass('toggled')) {
            $window.trigger('toggleListItem.alcatraz', data);
          }

          $item
            .children('ul')
            .first()
            .find('a')
            .first()
            .focus();
        } else if (
          $list
            .parent('li')
            .parent('ul')
            .hasClass('top-level')
        ) {
          // The focused nav item is on a second level sub level, so move focus up
          // one level to the sibling to the right of the parent item.
          $target = $list.parent('li').next('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target
            .find('a')
            .first()
            .focus();
        } else if (!$list.hasClass('top-level')) {
          // The focused nav item is on a third level sub level or deeper, so move
          // focus up one level and toggle the parent item's next sibling.
          $target = $list.parent('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target
            .next('li')
            .find('a')
            .first()
            .focus();
        }

        break;

      case 40: // Down arrow key.
        // Prevent window scrolling.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if ($item.children('ul').length && $list.hasClass('top-level')) {
          // The focused nav item has children and is on the top level,
          // so move focus down one level.
          $item
            .find('ul li')
            .first()
            .find('a')
            .first()
            .focus();
        } else if (!$list.hasClass('top-level') && $item.next('li').length) {
          // The focused nav item is on a sub level and has a sibling after it,
          // so move focus down one item.
          $item
            .next('li')
            .find('a')
            .first()
            .focus();
        }

        break;
    }

    return true;
  };

  /**
   * Toggle the mobile Primary Navigation.
   *
   * @since    1.0.0
   *
   * @returns  {object}  The original this.
   */
  const toggleMobileNav = function() {
    const $container = $('#site-navigation'),
      $menu = $container.find('#primary-menu');

    if ($container.hasClass('toggled')) {
      $body.removeClass('menu-open');
      $container.removeClass('toggled');
      $menu.attr('aria-expanded', 'false');
    } else {
      $body.addClass('menu-open');
      $container.addClass('toggled');
      $menu.attr('aria-expanded', 'true');
    }

    return this;
  };

  /**
   * Toggle a list item.
   *
   * @since    1.0.0
   *
   * @param    {object}  $item    The list item jQuery object.
   * @param    {object}  options  The toggle options.
   *
   * @returns  {object}           The original this.
   */
  const toggleListItem = function($item, options) {
    const $list = $item.parents('ul').last(),
      $toggle = $item.find('.sub-level-toggle').first(),
      $parent = $toggle.parents('li').last(),
      $sub = $item.find('ul').first(),
      args = options || {},
      autoClose = args.autoClose || false,
      duration = args.duration || 500;

    if (autoClose) {
      $list
        .find('ul')
        .not($parent.find('ul'))
        .slideUp(duration);
    }

    $item.toggleClass('toggled');
    $toggle
      .toggleClass('toggled')
      .blur()
      .next('ul')
      .slideToggle(duration)
      .toggleClass('toggled');

    // If we're toggling a menu item on the primary nav and the menu item has children,
    // detect whether they may be overflowing off the screen and add a class if they are.
    if (
      $list.is('#primary-menu') &&
      $item.hasClass('menu-item-has-children') &&
      $item.hasClass('toggled')
    ) {
      const rightEdge = $sub.width() + $sub.offset().left,
        screenWidth = $window.width();

      if (rightEdge > screenWidth) {
        $item.addClass('reverse-expand');
      }
    } else {
      // Delay removing the class so the slideup animation can finish.
      setTimeout(function() {
        $item.removeClass('reverse-expand');
      }, duration);
    }

    // Remove the 'toggled' class from lists and list items not in the current hierarchy.
    $list
      .find('.toggled')
      .not($parent)
      .not($parent.find('.toggled'))
      .removeClass('toggled');

    return this;
  };

  /**
   * Set up list toggle functionality on a <ul> element with child <ul> elements.
   *
   * @since    1.0.0
   *
   * @param    {object}  el       A jQuery object containing the ul elements.
   * @param    {object}  options  The toggle options.
   *
   * @returns  {object}           A jQuery object containing the ul elements.
   */
  const initListToggle = function(el, options) {
    const args = options || {};

    return $(el).each(function() {
      const $list = $(this),
        $items = $list.find('li'),
        $subList = $items.has('ul'),
        safeToggleText = Alcatraz.Utils.escapeHtml(toggleText);

      const toggle = `
        <button type="button" class="sub-level-toggle">
          <span class="screen-reader-text">${safeToggleText}</span>
        </button>`;

      // Add classes to indicate levels and items.
      $list.addClass('top-level');
      $list.find('ul').addClass('sub-level');
      $items.addClass('list-item');

      // Loop over each item that has a sub level and inject the toggle.
      $subList.each(function() {
        $(this)
          .find('a')
          .first()
          .after(toggle);
      });

      // Toggle the expanded state of sub levels when the toggles are clicked.
      $list.find('.sub-level-toggle').on('click', function(e) {
        e.preventDefault();

        const $item = $(this).parent('li'),
          data = {
            item: $item,
            args: args
          };

        $window.trigger('toggleListItem.alcatraz', data);
      });
    });
  };

  /**
   * Set up both the Primary and Sub Page navigation.
   *
   * @since    1.0.0
   *
   * @returns  {object}  The original this.
   */
  const initSiteNavigation = function() {
    initPrimaryNavigation();
    initSubPageNavigation();
    resetNavEventListeners();

    return this;
  };

  /**
   * Set up the Primary Navigation expand/contract functionality.
   *
   * @since    1.0.0
   *
   * @returns  {object}  The original this.
   */
  const initPrimaryNavigation = function() {
    const $container = $('#site-navigation');

    if (!$container) {
      return false;
    }

    const $toggle = $container.prev('.mobile-menu-toggle');

    if ('undefined' === typeof $toggle) {
      return false;
    }

    const $menu = $container.find('#primary-menu');

    if ('undefined' === typeof $menu) {
      $toggle.css('display', 'none');
      return false;
    }

    const $links = $menu.find('a'),
      $subMenus = $menu.find('ul'),
      $subLinks = $subMenus.find('a');

    $menu.attr('aria-expanded', 'false');

    if (!$menu.hasClass('nav-menu')) {
      $menu.addClass('nav-menu');
    }

    // Set up swipe-to-open support for the mobile nav.
    if ($.mobile) {
      if (
        $body.hasClass('mobile-nav-style-slide-left') ||
        $body.hasClass('mobile-nav-style-slide-right')
      ) {
        $.event.special.swipe.horizontalDistanceThreshold = 15;
        $(
          '#mobile-nav-swipe-zone, #mobile-navr-swipe-zone, .main-navigation .menu-overlay'
        ).on('swipeleft swiperight', function() {
          $window.trigger('toggleMobileNav.alcatraz');
        });
      }
    }

    // Set up the mobile nav toggle.
    $toggle.on('click', function() {
      $window.trigger('toggleMobileNav.alcatraz');
    });

    const $screen = $('.menu-screen');

    if ('undefined' !== typeof $screen) {
      // Allow a click on the screen to close the menu.
      $screen.on('click', function() {
        $window.trigger('toggleMobileNav.alcatraz');
      });
    }

    // Set up the sub menu dropdown toggles.
    const toggleOptions = { autoClose: true, duration: slideDuration };
    initListToggle($menu, toggleOptions);

    // Set menu items with sub menus to aria-haspopup="true".
    $subMenus.each(function() {
      $(this)
        .parent()
        .attr('aria-haspopup', 'true');
    });

    // Set menu item links inside sub menus to not be accessible via tabIndex.
    $subLinks.attr('tabIndex', '-1');

    // Each time a menu link is focused or blurred, toggle focus.
    $links.each(function() {
      $(this).on('focus blur', _toggleListFocus);
    });

    return this;
  };

  /**
   * Set up the Sub Page Navigation expand/contract functionality.
   *
   * @since    1.0.0
   *
   * @returns  {object}  The original this.
   */
  const initSubPageNavigation = function() {
    const $subNav = $('.alcatraz-sub-page-nav > ul');

    if (!$subNav.length) {
      return false;
    }

    const toggleOptions = { autoClose: false, duration: slideDuration };

    initListToggle($subNav, toggleOptions);

    // Each time a link is focused or blurred, toggle our 'focus' class.
    $subNav.find('a').each(function() {
      $(this).on('focus blur', _toggleListFocus);
    });

    return this;
  };

  /**
   * Set up the navigation event listeners.
   *
   * @since    1.0.0
   *
   * @returns  {object}  The original this.
   */
  const resetNavEventListeners = function() {
    // Mobile nav toggle.
    $window.off('toggleMobileNav.alcatraz', toggleMobileNav);
    $window.on('toggleMobileNav.alcatraz', toggleMobileNav);

    // List item toggle.
    $window.off('toggleListItem.alcatraz', _toggleListItem);
    $window.on('toggleListItem.alcatraz', _toggleListItem);

    // Nav item keyboard navigation.
    $window.off('keydown keyup', _toggleNavItemWithKeyboard);
    $window.on('keydown keyup', _toggleNavItemWithKeyboard);

    return this;
  };

  /**
   * Expose public methods.
   */
  return {
    toggleMobileNav: toggleMobileNav,
    toggleListItem: toggleListItem,
    initListToggle: initListToggle,
    initSiteNavigation: initSiteNavigation,
    initPrimaryNavigation: initPrimaryNavigation,
    initSubPageNavigation: initSubPageNavigation,
    resetNavEventListeners: resetNavEventListeners
  };
})(jQuery);
