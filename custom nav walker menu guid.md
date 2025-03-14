# Wp_Walker_Nav_Menu
*This file is wp nav walker. If you are wordpress theme or plugin developer I hope this file is very helpful for your project.*
   <br><br><br>
   
## nav_menu all markup styling

* STRUCTURE Of The Walker_Nav_Menu *
```html
    <ul> // function start_lvl
        <li> <a> <span> </a> </li> //function start_el()
    </ul>
```    
    *It's mean all ```<ul>```tag are controll by function start_lvl()
    *All ```<li><a>``` tag are controll by the function start_el().
 

* If you want change dropdown ul tags and this class. You have to modify this function class * 
`````php
 function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $dropdown = ( $depth == 0 )? 'dropdown-menu sub_dropdown': ''; //You just change @dropdown-menu
        $submenu = ( $depth > 0 )? 'sub-menu': '';  //You just change @sub-menu
        $dropSub = join(' ',array($dropdown,$submenu));
        $output .= "\n$indent <ul class=\" $dropSub\">";

    }
`````

* If you want to change li, a tags and class and ID. You will modify by this function *
##### All instruction manual are incluid this PHP Comment 
```php
function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = empty( $depth ) ? '': str_repeat( "\t", $depth );
        $classes_names = $value ='';
        $classes = empty( $item ->classes ) ? array() : (array) $item ->classes;
        /**
         * You Can change classes here
         */
        $classes[] = 'nav-item'; //All li element will taken this class.-- @nav-item
        $classes[] = ( $args->walker->has_children ) ? 'nav-item submenu dropdown' : ''; //Just dropdown li element taken this-- @dropdown 
        $classes[] = 'menu-item-'.$item->ID;  // make difference classes all deffernt deffernt menu
        $classes[] =( $depth && $args->walker->has_children ) ? 'dropdown-submenu' : '';//sunmenu's submenu @dropdown-submenu 
        $classes[] = ( $item->current || $item ->current_item_ancestor) ? 'active' : '';//Current @active

        $classes_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter( $classes, ), $item, $args ));
        $classes_names = 'class ="'.esc_attr($classes_names).'"' ;
        
        $id = apply_filters( 'nav_menu_item_id','menu-id-'.$item->ID, $item, $args );//May change menu id prefex or add static id
        $id = strlen($id) ? 'id="'.esc_attr($id).'"' : '';


        $output .= "\n".$indent."<li $id $classes_names>";


        /**
         * You controll all a tags and attributs here
         */
        $attributs = !empty( $item -> attr_title ) ? 'title = "' .esc_attr( $item -> attr_title ). '"' : '';
        $attributs .= !empty( $item -> target ) ? 'target = "' .esc_attr( $item -> target ). '"' : '';
        $attributs .= !empty( $item -> xfn ) ? 'rel = "' .esc_attr( $item -> xnf ). '"'  : '';
        $attributs .= !empty( $item -> url ) ? 'href = "' .esc_attr( $item -> url ). '" ' : '';
        //All ```<a>``` tags class change below $attributs
        $attributs .= ( $args->walker->has_children ) ? 'class = "dropdown-toggle nav-link" data-toggle="dropdown"' : 'class = "nav-link"'; //change <a> tags class

        $item_output = $args-> before;
        $item_output .= '<a ' .$attributs. '>';
        $item_output .= $args -> link_before . apply_filters( 'the_title', $item -> title, $item-> ID ).$args-> link_after;
        $item_output .= ( $depth == 0 && $args->walker->has_children ) ? '</a>' : '</a>';
        $item_output .= $args-> after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output , $item, $depth, $args );
        
        

```     

##### One more things this walker class made by targeting Bootstrap-4. If you working on bootstrap-4 menu you will use this code directly. All step here...

##### First include or paste this code your header.php or index.php file.

```php
<header class="header-area">
	 <div class="header-section">
	 	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			 <div class="container">
				<a href="#" class="navbar-brand"> EFT </a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	 				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<?php
					$args= array(
						'theme_location' 	=> 	'primary_menu',
						'container'    		=> 	' ',
						'menu_class'		=>	'navbar-nav nav justify-content-end menu_nav',
						'walker'			=> 	new eft_Walker_Nav(),
					);
					 	wp_nav_menu( $args ); 
					 ?>
				</div>
			 </div>
		 </nav>
	 </div>
</header>
```
##### Second go this link and copy all code and paste your functions.php file https://github.com/emon916381/Wp-Nav-Walker/blob/master/Custom%20Nav%20Walker.php 

####### Paste this code your style.css file. It is not recommended but you can.
```css
.menu_nav{
    width: 100%;
}
.sub_dropdown{
   background-color:  #343a40;
}
@media (min-width: 768px){
    .dropdown:hover> .dropdown-menu{
        display: block;
        margin-top: -2px;
    }

}

 ```

###### This file is open. If you developed this code better, email me. My E-mail Id: emon916381@gmail.com



