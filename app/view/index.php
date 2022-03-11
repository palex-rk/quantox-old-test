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
        <nav class= "navbar navbar-expand navbar-light bg-light">
            <a href="/"  class= "navbar-brand"> Index </a>
            <a href="/index.php?c=UsersController&m=create"  class= "navbar-brand"> Add User </a>
        </nav>

        <?php echo $errorMessage ?>

        <div class= "col-6 offset-3 ">
            <table class="table  table-striped mt-5">
                <thead class="thead-light">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th> 
                        <th class= "text-center">Action</th>
                    </tr>
                </thead>

                    <?php foreach ($users as $user): ?>  
                        <tbody>       
                            <tr>
                                <td> <?php echo $user['name']; ?> </td> 
                                <td> <?php echo $user['email']; ?> </td>
                                <td> <?php echo $user['phone']; ?> </td>
                                <td> <?php echo $user['address']; ?> </td>
                                <td>     
                                    <div class="d-inline-block float-right ">
                                        <a href="/index.php?c=UsersController&m=edit&user_id=<?php echo $user['id']?>" 
                                            class = " btn btn-info navbar-btn mr-2">Edit</a>
                                        <a href="/index.php?c=UsersController&m=delete&user_id=<?php echo $user['id']?>"  onclick="return confirm('Are you sure?')"
                                            class = "btn btn-danger navbar-btn mr-2">Delete</a>
                                    </div>  
                                </td> 
                            </tr>
                        </tbody>    
                            
                    <?php endforeach ?>
                        
            </table> 
        </div>     

    </body>
</htm>
