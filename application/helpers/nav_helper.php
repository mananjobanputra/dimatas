<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Codeigniter Navigation Helper
*
* This is a small helper to create dynamic navigation menus in codeigniter. 
*
* @author Ramon Lapenta <me@ramonlapenta.com>
* @copyright Public Domain
* @license http://ramonlapenta.com/license.txt
*
*/


// menu()  ------------------------------------------------------------------------

if ( ! function_exists('menu'))
{
    function menu( $items, $sel = '', $class = '' )
   {
        if( ! empty( $class ) ) {
            $menu = '<ul class="' . $class . '">' . "\n";
        } else {
            $menu = '<ul>' . "\n";
        }
        foreach( $items as $item ) {
            $attr =  $item['attr'];
            $icon =  $item['icon'];
            $badges_function =  $item['badges_function'];
            $children=$item['children'];
            $hasSub=(!empty($children))?true:false;
            $li_class=($hasSub)?"hasSub":'';
            $current = ( in_array( $sel, $item ) ) ? ' class="onTap"' : '';
            $menu.= '<li' . $current. ' '.$li_class.'>';
            $menu.= '<a href="' . base_url() . $item['link'] . '"'.$attr . '>';
            if($icon!=''){
                $menu.='<span class="navIcon '.$icon.'"></span>';
            }
            $menu.='<span class="navLabel">'.$item['text'].'</span>';
            if($hasSub){
                $menu.='<span class="fa fa-angle-left arrowRight"></span>';
            }
            if($badges_function!=''){
                $count_array=$badges_function();
                $count=$count_array['count'];
                $badges_class=$count_array['class'];

                $menu.='<span class="badge '.$badges_class.'">'.$count.'</span>';
            }
            $menu.='</a>';
            if($hasSub){
                $menu=.$this->menu($children);
            }
            $menu=.'</li>' . "\n";
        }
        $menu .= '</ul>' . "\n";
        return $menu;
    }
}

/* End of file nav_helper.php */
/* Location: ./system/helpers/nav_helper.php */