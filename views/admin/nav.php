<div class="modal fade bd-example-modal-lg" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modal-lg-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-lg-body">
      </div>
      <div class="modal-footer" id="modal-lg-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    </div>
  </div>
</div>
<div class="modal fade" id="modal-sm-center">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-sm-title">Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-sm-body">
      </div>
      <div class="modal-footer" id="modal-sm-footer">
        </div>
    </div>
  </div>
</div>
  <nav class="navbar navbar-expand-lg navbar-light bg-danger fixed-top ">
    <div class="container-fluid">
    <a class="navbar-brand text-white" href="/promotions/admin">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-globe"></i>  Sites
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php if($_SESSION['admin_user_previlleges']['create_user']=="true"){
            ?>
            <a class="dropdown-item" id="users" href="#"><i class="bi bi-people-fill"></i> Users</a>
            <?php
          }?>

          <a class="dropdown-item" id="promotions" href="#"><i class="bi bi-signpost-split"></i> Promotions</a>
          <div class="dropdown-divider"></div>
         </div>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="bi bi-plus-circle"></i> New
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php if($_SESSION['admin_user_previlleges']['create_user']=="true"){
            ?>
            <a class="dropdown-item" id="new-users" href="#" data-target='#modal-lg'  data-toggle='modal'><i class="bi bi-person-plus"></i> New User</a>
            <?php
          }?>
          <a class="dropdown-item" id="new-promotions" href="#" data-target='#modal-lg'  data-toggle='modal'><i class="bi bi-plus"></i> New Promotions</a>

        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-person-fill"></i> <?=$_SESSION['isadminuser']?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              
              <hr>
              <a class="dropdown-item" href="#" onClick="logOut()"> <i class="bi bi-power"></i> Logout</a>
          </div>
        </li>
    </ul>
</div>
</nav>
