<?php




?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> 
  <a class="navbar-brand menu_a menu-brand" 
  href="<?php echo "$myURL/index.php"?>">
    Survey Center
  </a> 
  <button class="navbar-toggler" type="button" data-toggle="collapse" 
  data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" 
  aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link menu_a site-menu-link" 
        href="<?php echo "$myURL/index.php"?>" >
          Home 
        </a>
      </li>
      <?php
        if($_SESSION['type'] == 'Admin')
        {
          echo '
          <li class="nav-item">
            <a class="nav-link menu_a site-menu-link" href="
            '.$myURL.'/documents/study_body.php">
              Studies
            </a>
          </li>';
        }
      ?>
      <li class="nav-item">
        <a class="nav-link menu_a site-menu-link" href="
        <?php echo "$myURL/documents/interview_body.php"?>">
          Interviews
        </a>
      </li>
      <?php
        if($_SESSION['type'] == 'Admin')
        {
          echo '
          <li class="nav-item">
            <a class="nav-link menu_a site-menu-link" href="
            '.$myURL.'/documents/population_body.php">
              Populations
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu_a site-menu-link" href="'.$myURL.'/documents/users_body.php">
              Users
            </a>
          </li>';
        }
      ?>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">        
        <a class="nav-link dropdown-toggle menu_a" data-toggle="dropdown">
            <?php echo $_SESSION['uname']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right mydarkdrop" 
        aria-labelledby="navbarDropdownMenuLink">
            <a id="menu_logout" href="<?php 
              echo $myURL."/documents/login.php";
            ?>" class="dropdown-item menu_a">
              Logout
            </a>
        </div>
      </li>
    </ul>
  </div>
</nav>


