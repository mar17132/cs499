<?php




?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">  
  <button class="navbar-toggler" type="button" data-toggle="collapse" 
  data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" 
  aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link active menu_a" href="#">
          Home 
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link menu_a" href="#">
          Studys
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link menu_a" href="#">
          Interviews
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link menu_a" href="#">
          Populations
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link menu_a" href="#">
          Users
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">        
        <a class="nav-link dropdown-toggle menu_a" data-toggle="dropdown">
            <?php echo $_SESSION['uname']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right mydarkdrop" 
        aria-labelledby="navbarDropdownMenuLink">
            <a id="menu_logout" class="dropdown-item menu_a">
              Logout
            </a>
        </div>
      </li>
    </ul>
  </div>
</nav>


