<?php 

// main menu
if( !function_exists( 'sciencexlite_main_menu' ) ){

	function sciencexlite_main_menu(){
		 wp_nav_menu( array( 
            'theme_location' => 'sciencexlite-primary', 
            'depth' => 3,
            'container' => false,
            'menu_class' => 'nav navbar-nav navbar-right',
            'menu_id'   => 'menu-main-nav',
            'fallback_cb' => 'sciencexlite_menu_setting',
            'walker' => new WP_Sciencexlite_Bootstrap_Navwalker()
        ) ); 
	}
}



// menu settings
if( ! function_exists( 'sciencexlite_menu_setting' ) ){
	function sciencexlite_menu_setting(){
		?>
		<div>
		    <ul class="nav navbar-nav navbar-right menu-setting" id="menu-main-nav">
		      <?php if( is_user_logged_in() ): ?>
		        <li class="active">
		            <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
		                <?php echo esc_html__('Create A Menu', 'sciencex-lite');?>
		            </a>
		        </li>
		      <?php else: ?>
		        <li class="active">
		            <a href="<?php echo esc_url( home_url('/') );?>">
		                <?php echo esc_html__('Home', 'sciencex-lite');?>
		            </a>
		        </li>
		        <?php endif; ?>
		    </ul>
	    </div>
       <?php 
	}
}

// sciencexlite pagination
function sciencexlite_pagination( $numpages = ''){
    if ($numpages == '') {
	    global $wp_query;
	    $numpages = $wp_query->max_num_pages;
	    if(!$numpages) {
	        $numpages = 1;
	    }
	}
        
  $big = 999999999; // need an unlikely integer
  echo paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'       => '',
      'add_args'     => '',
      'current'      => max( 1, get_query_var( 'paged' ) ),
      'total'        => $numpages,
      'prev_text'    => '<i class="ion-arrow-left-c"></i>' .esc_html__( 'Prev', 'sciencex-lite' ),
      'next_text'    => esc_html__( 'Next', 'sciencex-lite' ) . '<i class="ion-arrow-right-c"></i>',
      'type'         => 'list',
      'end_size'     => 2,
      'mid_size'     => 2
    ) );
}