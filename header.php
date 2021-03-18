<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/ssd-cwk1-bae/index.php">BAE MOBILES LTD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
            aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item">
                  <a class="nav-link" href="/ssd-cwk1-bae/index.php">Browse Products</a>
              </li>
                <li class="nav-item">
                    <?php
                        // if signed in, show 'My Profile (Full Name)'
                        // if not, show Sign in
                        if (!isset($_SESSION['id'])) {
                          echo "<a class=\"nav-link\" href=\"/ssd-cwk1-bae/log.php\">Sign in</a>";
                        } else {
                            $fullName = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            echo "<a class=\"nav-link\" href=\"/ssd-cwk1-bae/dashboard.php\">My profile ($fullName)</a>";
                            
                        }
                    ?>
                </li>
                <li class="nav-item">
                        <a class="btn btn-primary" href="/ssd-cwk1-bae/photo/upload-design.php">Post ad!</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
