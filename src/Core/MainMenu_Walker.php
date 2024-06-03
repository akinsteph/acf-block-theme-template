<?php

 namespace AbttWP\Core;

 use Walker_Nav_Menu;

class MainMenu_Walker extends Walker_Nav_Menu
{
    private $menu_index = 0;

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        if ($item) { // Check if the menu item exists
            $li_class = ($item->current || $item->current_item_ancestor) ? 'nav-content-item active' : 'nav-content-item';

            $output .= "<li class='{$li_class}'>";
            $output .= '<sub> (0' . ++$this->menu_index . ')</sub>';
            $output .= '<a class="nav-content-item-link" href="' . $item->url . '">';
            $output .= $item->title;
            $output .= '</a></li>';
        }
    }
}
