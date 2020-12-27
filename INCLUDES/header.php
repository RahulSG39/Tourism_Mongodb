<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tourism Management System</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <style>
                @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap');
                @import url('https://fonts.googleapis.com/css2?family=Heebo&family=Roboto+Slab&display=swap');
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    /* font-family: 'Roboto Slab', serif;                 */
                    font-family: 'Heebo', sans-serif;
                }

                #top-nav {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    width: 95%;
                    margin: auto;
                }

                #top-nav a{
                    color: white;
                }

                .nav-item {
                    margin-left: 10px;
                }

                #top-nav  .nav-item a:hover{
                  border-bottom: 1px solid white;
                  background: white;
                  color: black;
                  transition: 0.5s;
                }

                .narbar-brand a{
                  margin-left: 40px;
                }


    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg sticky-top" id="top-nav">
      <a class="navbar-brand" href="#">TMS</a>
      <div class="right-elements">
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="./index.php"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./packages.php">Packages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./terms.php">Terms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./contact.php">Contact</a>
            </li>
            <?php if(session_status() == PHP_SESSION_NONE){?>
            <li class="nav-item">
              <a class="nav-link" href="Reg_Sign.php">Sign In</a>
            </li>
            <?php } else if(basename($_SERVER['PHP_SELF'])!='Reg_Sign.php') {?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Sign Out</a>
            </li>
            <?php }?>
          </ul>
        </div>
      </div>
    </nav>

    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
      integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
      crossorigin="anonymous"
    ></script>