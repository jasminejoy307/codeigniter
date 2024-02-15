<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        * {box-sizing: border-box}

        /* Center the form on the page */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
            width: 300px; /* Set the width of the form container */
        }

        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit/register button */
        .registerbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity:1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
        .error-message {
        color: red;
    }
</style>
    </style>
</head>
<body>

  

    

    <form action="" method="post">
        <div class="container">
            <h2>Registration</h2>
           
            <hr>
            <label for="name"><b>Full Name</b></label>
            <input type="text" placeholder="Enter Full Name" name="name" id="name" required>
            <span class="error-message"><?php echo form_error('name'); ?></span>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>
            <span class="error-message"><?php echo form_error('email'); ?></span>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>
            <span class="error-message"><?php echo form_error('password'); ?></span>
            <hr>

            <button type="submit" class="registerbtn">Register</button>
        </div>

        <div class="container signin">
            <p>Already have an account? <a href="<?php echo site_url('login');?>">Login</a>.</p>
        </div>
    </form>

</body>
</html>
