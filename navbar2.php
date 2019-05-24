<!DOCTYPE html>
<head>
    <title>MovieMate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/header.css">
</head>
<body>    
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="profile.php">User profile</a></li>
        <li><a href="register.php">Create user</a></li>
        <li><a href="login.php">Logga in</a></li>

        <li class="nav-item">
            <form class="form-inline" action="searchpage.php?title=" method="GET" id="search_form">
                <i class="fas fa-search" aria-hidden="true"></i>
                <input class="form-control form-control-sm ml-3 w-75" name="title" type="text" placeholder="Search"
                    aria-label="Search">
            </form>
        </li>
    </ul>
</body>

<script>
    $(document).ready(function () {
        $('#autolocation').keydown(function (event) {
            // enter has keyCode = 13
            if (event.keyCode == 13) {
                $('#search_form')submit(); // submit the form
                return false;
            }
        });
    });
</script>