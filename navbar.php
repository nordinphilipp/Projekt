<!DOCTYPE html>
<head>
    <title>MovieMate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

           <nav class="navbar navbar-expand-lg navbar-light justify-content-end" style="min-height: 7vh;">
            <a class="navbar-brand nav-link active" href="#"><b>MovieMate</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flow-grow-0" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-item nav-link white-text" href="#"><b>Browse</b></a>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline"action="searchpage.php?title=" method="GET" id="search_form">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input class="form-control form-control-sm ml-3 w-75" name="title" type="text" placeholder="Search" aria-label="Search">
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-item nav-link white-text" href="#" style="margin-right: 1vw;"><b>Login/Register</b></a>
                    </li>
                </ul>
            </div>
        </nav>
        <script>
$(document).ready(function() {
  $('#autolocation').keydown(function(event) {
    // enter has keyCode = 13
    if (event.keyCode == 13) {
      $('#search_form')submit(); // submit the form
      return false;
    }
  });
});
</script>


