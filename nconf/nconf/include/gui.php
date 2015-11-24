<?php
##
## GUI settings
##

#
# History Tab in detail view
# How much entries listed
#
define("HISTORY_TAB_LIMIT",          "10");


#
# Admin only fields (DISABLED for ordinary users)
#
$ADMIN_ONLY = array ("host_is_collector", "nc_permission");


# Labels & text
define("SELECT_NAME_NAGIOSSERVER",  "Nagiosserver");
define("FRIENDLY_NAME_NAGIOSSERVER","monitored by");
define("FRIENDLY_NAME_IPADDRESS",   "IP-address");
define("FRIENDLY_NAME_OS",          "OS");
define("FRIENDLY_NAME_DETAILS",     "details");
define("FRIENDLY_NAME_EDIT",        "edit");
define("FRIENDLY_NAME_DELETE",      "delete");
define("FRIENDLY_NAME_SERVICES",    "services");
define("FRIENDLY_NAME_CLONE",       "clone");
define("OVERVIEW_DETAILS",          "details");



# what to display in an empty field of a select box
define("SELECT_EMPTY_FIELD",        "&nbsp;");

# Navigation: Name of standard user and admin part
define("TXT_MENU_BASIC",            "Basic Items");             # USER MENU
define("TXT_MENU_ADDITIONAL",       "Additional Items");        # ADMIN MENU



##
## ICONS
##

#
# OS icons
#
define("OS_LOGO_SIZE", "width=18 height=18");
define("FRIENDLY_NAME_OS_LOGO", "");    // Title above icons in overvuew



#
# overview icons
#
define("OVERVIEW_EDIT",             '<img src="img/icon_edit_16.gif">');
define("OVERVIEW_DELETE",           '<img src="img/icon_delete_16.gif">');
define("OVERVIEW_SERVICES",         '<img src="img/icon_service.gif">');

# generell icons
define("ICON_EDIT",                 '<img src="img/icon_edit_16.gif">');
define("ICON_DELETE",               '<img src="img/icon_delete_16.gif">');
define("ICON_SERVICES",             '<img src="img/icon_service.gif">');
define("ICON_HISTORY",              '<img src="img/icon_history.gif">');
define("ICON_CLONE",                '<img src="img/icon_clone_16.gif">');
define("ICON_DEPENDENCY",           '<img src="img/icon_up.png">');
define("ICON_WARNING",              '<img width=24 height=24 src="img/icon_warning.png" alt="warn">');

define("ICON_LEFT",                 'img/icon_left.gif');
define("ICON_LEFT_OVER",            'img/icon_left_over.gif');

define("ICON_LEFT2",                'img/icon_left2.gif');

define("ICON_LEFT_FIRST",           'img/icon_left_first.gif');
define("ICON_LEFT_FIRST_OVER",      'img/icon_left_first_over.gif');

define("ICON_RIGHT",                'img/icon_right.gif');
define("ICON_RIGHT_OVER",           'img/icon_right_over.gif');

define("ICON_RIGHT2",               'img/icon_right2.gif');

define("ICON_RIGHT_LAST",           'img/icon_right_last.gif');
define("ICON_RIGHT_LAST_OVER",      'img/icon_right_last_over.gif');

# Animated icons
define("ICON_LEFT_ANIMATED",        '<img src="'.ICON_LEFT.'" '
                                    .'onmouseover="this.src=\''.ICON_LEFT_OVER.'\'" '
                                    .'onmouseout="this.src = \''.ICON_LEFT.'\'"
                                     >');
define("ICON_LEFT_FIRST_ANIMATED",  '<img src="'.ICON_LEFT_FIRST.'" '
                                    .'onmouseover="this.src=\''.ICON_LEFT_FIRST_OVER.'\'" '
                                    .'onmouseout="this.src = \''.ICON_LEFT_FIRST.'\'"
                                     >');
define("ICON_RIGHT_ANIMATED",        '<img src="'.ICON_RIGHT.'" '
                                    .'onmouseover="this.src=\''.ICON_RIGHT_OVER.'\'" '
                                    .'onmouseout="this.src = \''.ICON_RIGHT.'\'"
                                     >');
define("ICON_RIGHT_LAST_ANIMATED", '<img src="'.ICON_RIGHT_LAST.'" '
                                    .'onmouseover="this.src=\''.ICON_RIGHT_LAST_OVER.'\'" '
                                    .'onmouseout="this.src = \''.ICON_RIGHT_LAST.'\'"
                                     >');


# advanced tab submit icons
define("ADVANCED_ICON_CLONE",       'img/icon_clone_16.gif');
define("ADVANCED_ICON_MULTIMODIFY", 'img/icon_multi_modify.gif');
define("ADVANCED_ICON_DELETE",      'img/icon_delete_16.gif');
define("ADVANCED_ICON_SELECT",      'img/icon_check_box.gif');


#
# overview list
#
# selectable quantity on overview
define('QUANTITY_SMALL',  '25');
define('QUANTITY_MEDIUM', '50');
define('QUANTITY_LARGE',  '100');


#
# show attribute icons
#
define("SHOW_ATTR_YES",             '<img width=24 height=24 src="img/icon_yes.png">');
define("SHOW_ATTR_NO",              '<img width=24 height=24 src="img/icon_minus_24.gif">');
define("SHOW_ATTR_UP",              '<img src="img/icon_up.png">');
define("SHOW_ATTR_DOWN",            '<img src="img/icon_down.png">');

define("SHOW_ATTR_TEXT",            '<img src="img/text.gif" alt="text">');
define("SHOW_ATTR_PASSWORD",        '<img src="img/password.gif" alt="password">');
define("SHOW_ATTR_SELECT",          '<img width=24 height=24 src="img/icon_select.png" alt="select">');
define("SHOW_ATTR_ASSIGN_ONE",      '<img width=24 height=24 src="img/icon_assign_one.png" alt="assign one">');
define("SHOW_ATTR_ASSIGN_MANY",     '<img width=24 height=24 src="img/icon_assign_many.png" alt="assign may">');
define("SHOW_ATTR_NAMING_ATTR",     '<img width=24 height=24 src="img/icon_naming_attr.png" alt="naming attr">');
define("SHOW_ATTR_NAMING_ATTR_CONFLICT",    '<img width=24 height=24 src="img/icon_warning.png" alt="warn">');


# icons in detail view
define("DETAIL_EDIT",               '<img align="right" src="img/icon_edit_16.gif">');
define("DETAIL_DELETE",             '<img align="right" src="img/icon_delete_16.gif">');
define("DETAIL_HISTORY",            '<img align="right" src="img/icon_history.gif">');
define("DETAIL_CLONE",              '<img align="right" src="img/icon_clone_16.gif">');
define("DETAIL_SERVICES",           '<img align="right" src="img/icon_service.gif">');


# size of multi-select box
define("CSS_SELECT_MULTI",          "height:155px");


# Tree view
define("TREE_PLUS",         'img/tree_plus.gif');
define("TREE_PLUS_LAST",    'img/tree_plus_last.gif');
define("TREE_MINUS",        'img/tree_minus.gif');
define("TREE_MINUS_LAST",   'img/tree_minus_last.gif');
define("TREE_ITEM",         'img/tree_item.gif');
define("TREE_ITEM_LAST",    'img/tree_item_last.gif');
define("TREE_SPACE",        'img/tree_space.gif');
define("TREE_LINE",         'img/tree_line.gif');
define("TREE_FOLDER",       'img/tree_folder.gif');
define("TREE_PARENT",       'img/tree_parent.gif');
define("TREE_SERVICE",      'img/tree_service.gif');
define("TREE_INFO",         'img/tree_info.gif');
define("TREE_WARNING",      'img/icon_warning.png');

?>
