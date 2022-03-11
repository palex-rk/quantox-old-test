<!DOCTYPE html>
<htm>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Index </title>
        <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
        <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" >
        <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" >
        <link rel= "styleshit" href= "css/main.css" type=text/css > 
    </head>

    <body>

        <nav class= "navbar navbar-expand navbar-light bg-light mb-5">
            <a href="index"  class= "navbar-brand">Index</a>
            <a href="/index.php?c=UsersController&m=create"  class= "navbar-brand"> Add User </a>
        </nav>

        <div class="container">
            <form method="POST" action="/index.php?c=UsersController&m=update">
                <input type="hidden" name="id"  class="form-control" value="<?php echo $user['id']; ?>" />
                
                <div class="form-group">
                    Name: <input type="text" class="form-control"name="name" value="<?php echo $user['name']; ?>" /><br />
                </div>    

                <div class="form-group">    
                    Email: <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" /><br />
                </div>  

                <div class="form-group">
                    Address: <input type="text"  class="form-control" name="address" value="<?php echo $user['address']; ?>" /><br />
                </div>  

                <div class="form-group">
                    Phone: <input type="text"  class="form-control" name="phone" value="<?php echo $user['phone']; ?>" /><br />
                </div>    

                <input type="submit" class="btn btn-info" value="Update"/>

            </form>
        </div>
    </body>
</html>    