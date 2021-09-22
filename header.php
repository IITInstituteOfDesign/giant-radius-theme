  <?php
    $show_button_in_header = get_field('show_button_in_header', 'option');
    $button_url = get_field('button_url', 'option');
    $nav_menu = wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'custom-header', 'echo' => false, ) );
  ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZ2H6D"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <header id="head-nav" class="scroll">
    <div class="container home-head--nav">
      <div class="row">
        <div class="col">
          <nav>
           <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="link-item">
                <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/' ?>IIT_ID_Logo.png" class="logo" alt="IIT Institute of Design" />
            </a>
            <?php echo $nav_menu; ?>
            <?php if ($show_button_in_header == true):?>
              <?php if (get_field('button_header_position', 'option') == 'Left'):?>
                <a href='<?php echo $button_url; ?>' class='btn-apply btn-apply--left' target='_blank'>APPLY</a>
              <?php endif; ?>
            <?php endif; ?>
          </nav>
          <div class="menu-nav">
            <?php echo $nav_menu; ?>
            <?php if ($show_button_in_header == true):?>
              <?php if (get_field('button_header_position', 'option') == 'Left'):?>
                <a href='<?php echo $button_url; ?>' class='btn-apply' target='_blank'>APPLY</a>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <a href="#" class="btn-menu" id="btn-menu"><span></span><span></span><span></span></a>
          <?php if ($show_button_in_header == true):?>
            <?php if (get_field('button_header_position', 'option') == 'Right'):?>
              <a href='<?php echo $button_url; ?>' class='btn-apply' target='_blank'>APPLY</a>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
