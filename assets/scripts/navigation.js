/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
    const siteNavigation = document.getElementById( 'site-navigation' );

    // Return early if the navigation doesn't exist.
    if ( ! siteNavigation ) {
        return;
    }

    const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];

    // Return early if the button doesn't exist.
    if ( 'undefined' === typeof button ) {
        return;
    }

    const buttons = siteNavigation.querySelectorAll( 'button' );

    // Loop through all buttons within the current .site-navigation.
    buttons.forEach( function( button ) {
        const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

        // Hide menu toggle button if menu is empty and return early.
        if ( 'undefined' === typeof menu ) {
            button.style.display = 'none';
            return;
        }

        if ( ! menu.classList.contains( 'nav-menu' ) ) {
            menu.classList.add( 'nav-menu' );
        }

        // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
        button.addEventListener( 'click', function() {
            siteNavigation.classList.toggle( 'toggled' );

            if ( siteNavigation.classList.contains( 'toggled' ) ) {
                document.body.classList.add( 'has-open-menu' );
            } else {
                document.body.classList.remove( 'has-open-menu' );
            }

            if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
                button.setAttribute( 'aria-expanded', 'false' );
            } else {
                button.setAttribute( 'aria-expanded', 'true' );
            }
        } );

        // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
        document.addEventListener( 'click', function( event ) {
            const isClickInside = siteNavigation.contains( event.target );

            if ( ! isClickInside ) {
                siteNavigation.classList.remove( 'toggled' );
                button.setAttribute( 'aria-expanded', 'false' );
            }
        } );
    } );

    // Get all the link elements within the menu.
    const links = document.querySelectorAll( '.site-navigation .nav-menu a' );

    // Get all the link elements with children within the menu.
    const linksWithChildren = document.querySelectorAll( '.site-navigation .nav-menu .menu-item-has-children > a, .site-navigation .nav-menu .page_item_has_children > a' );

    // Toggle focus each time a menu link is focused or blurred.
    links.forEach( function( link ) {
        link.addEventListener( 'focus', toggleFocus, true );
        link.addEventListener( 'blur', toggleFocus, true );
    } );

    // Toggle focus each time a menu link with children receive a touch event.
    linksWithChildren.forEach( function( link ) {
        link.addEventListener( 'touchstart', toggleFocus, false );
    } );

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        if ( event.type === 'focus' || event.type === 'blur' ) {
            let self = this;
            // Move up through the ancestors of the current link until we hit .nav-menu.
            while ( ! self.classList.contains( 'nav-menu' ) ) {
                // On li elements toggle the class .focus.
                if ( 'li' === self.tagName.toLowerCase() ) {
                    self.classList.toggle( 'focus' );
                }
                self = self.parentNode;
            }
        }

        if ( event.type === 'touchstart' ) {
            const menuItem = this.parentNode;
            event.preventDefault();
            for ( const link of menuItem.parentNode.children ) {
                if ( menuItem !== link ) {
                    link.classList.remove( 'focus' );
                }
            }
            menuItem.classList.toggle( 'focus' );
        }
    }
}() );
