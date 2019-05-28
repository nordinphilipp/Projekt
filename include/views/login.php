	<html lang="en">
        <body>
			<div class="container-fluid red lighten-1" style="height: 90vh">
				<div class="center-box red darken-4 white-text">
					<div class="row-title">MovieMate Login</div>
                    
                        <form name="minForm" onsubmit="return validateLogin()" method="POST">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Email/Username:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="staticEmail" name="email" placeholder="user@mail.com">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    Forgot password?<br>Register
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn red lighten-1" name="send" value="Skicka"/>Submit</button>
                                </div>
                            </div>
                        </form>
				    </div>
			    </div>
		    </div>
        </body>
    </html>