<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
  <a class="navbar-brand" href="#">Inventory System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><i class="fa fa-home">&nbsp;</i>Home <span class="sr-only">(current)</span></a>
      </li>
      
        <?php
          if (isset($_SESSION["userid"])) {
            ?>
            <li class="nav-item active">
              <a class="nav-link" href="logout.php"><i class="fa fa-user">&nbsp;</i>Logout</a>
            </li>
            <?php
          }
        ?>
        <li class="nav-item active" style="float:right;">
        <iframe src="http://free.timeanddate.com/clock/i6h7lusm/n1648/tlin/fn14/fs17/fcfff/tct/pct/bls0/brs0/bts0/bbs0/pl16/pr0/pt2/pb0/tt0/td1/th2/tb2" frameborder="0" width="362" height="23" allowTransparency="true"></iframe>    </ul>
  </div>
</nav>