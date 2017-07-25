<header class="banner">
  <!-- <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div> -->

  <!-- Copied and pasted from Bootstrap components page. -->
  <!-- <nav class="navbar navbar-toggleable-sm navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#tuckerNav2" aria-controls="tuckerNav2" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand branding-test" href="#">Navbar</a>

    <div class="collapse navbar-collapse" id="tuckerNav2">
      <ul class="navbar-nav mr-auto mt-2 mt-md-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav> -->

  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tuckerNav" aria-controls="tuckerNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"></a>

    <div class="collapse navbar-collapse" id="tuckerNav">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav']);
      endif;
      ?>

      <!-- The above returns the below! -->
      <!-- <ul id="menu-menu-1" class="navbar-nav">
        <li class="menu-item menu-item-has-children menu-about-us">
          <a href="#" data-toggle="dropdown">About Us</a>
          <ul class="sub-menu">
            <li class="menu-item menu-board"><a href="#">Board</a></li>
            <li class="menu-item menu-staff"><a href="#">Staff</a></li>
          </ul>
        </li>
        <li class="menu-item menu-item-has-children menu-programs"><a href="#" data-toggle="dropdown">Programs</a>
          <ul class="sub-menu">
            <li class="menu-item menu-country-fun">
              <a href="#">Country Fun</a>
            </li>
            <li class="menu-item menu-sample-page">
              <a href="http://maisontuckerhouse.dev/en/sample-page/">Sample Page</a>
            </li>
          </ul>
        </li>
        <li class="menu-item menu-donate">
          <a href="#">Donate</a>
        </li>
        <li class="menu-item menu-contact">
          <a href="#">Contact</a>
        </li>
      </ul> -->

      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> -->
    </div>
  </nav>
</header>
