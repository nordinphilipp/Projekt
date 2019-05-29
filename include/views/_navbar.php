<body>    
    <ul class='header'>
        <li class="left"><a href="index.php">Home</a></li>       
        
        <?php if(!empty($_SESSION['logged_in'])){?>
            <li class="left"><a href="profile.php">User profile</a></li>
            <li class="right rightmost"><a href="logout.php">Logga ut</a></li>
        <?php }else{ ?>
            <li class="left"><a href="register.php">Create user</a></li>
            <li class="right rightmost"><a href="login.php">Logga in</a></li>
        <?php }?>

        <li class="right"><a href="list.php">Listor</a></li>

        <li class="nav-item right">
            <form class="form-inline" action="searchpage.php?title=" method="GET" id="search_form">
                <i class="fas fa-search" aria-hidden="true"></i>
                <input class="form-control form-control-sm ml-3 w-75" name="title" type="text" placeholder="Search"
                    aria-label="Search">
            </form>
        </li>

    </ul>
</body>

<script src='assets/js/searchbar.js'></script>
