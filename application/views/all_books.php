<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color:#c5b5b5;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            display: flex;
            background-color: #444;
            padding: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin-right: 10px;
        }

        section {
            padding: 20px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .edit-btn, .delete-btn {
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            border-radius: 3px;
            margin-right: 5px;
        }

        .delete-btn {
            background-color: #f44336;
        }
        .add-book-btn {
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            background-color: #2196F3;
            border-radius: 3px;
            margin-bottom: 20px;
            display: inline-block;
            float: right; /* Align to the right */
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="file"] {
            margin-top: 10px;
        }
        #filter-form {
        text-align: right;
        margin: 10px; /* Adjust margin as needed */
    }

    #category_filter {
        width: 150px; /* Adjust width as needed */
        margin-right: 10px; /* Adjust margin as needed */
    }

    #filter-btn {
        width: auto; /* Adjust width as needed */
    }</style>
</head>
<body>

    <header>
        <h1>Welcome to the Dashboard</h1>
    </header>

    <nav>
        <a href="<?php echo site_url('dashboard');?>">My Books</a>
        <a href="<?php echo site_url('category');?>">Category</a>
        <a href="<?php echo site_url('all_books');?>">View All books</a>
        <a href="<?php echo site_url('login');?>">Logout</a>
    </nav>

    <section>
        <h2>Books</h2>
        <form id="filter-form" action="<?php echo base_url('book/all_books'); ?>" method="get" style="display: inline-block;">
    <label for="category_filter">Filter by Category:</label>
    <select id="category_filter" name="category">
        <option value="">All Categories</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['category_id']; ?>">
                <?php echo $category['category_name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button id="filter-btn" type="submit">Filter</button>
</form>
        <!-- Table for Book Information -->
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Publication Date</th>
                    <th>Category</th>
                    <th>Pdf File</th>
                  
                </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['description']; ?></td>
                    <td><?php echo $book['publication_date']; ?></td>
                    <td><?php echo $book['category_name']; ?></td>
                    <td>
                        <a href="<?php echo base_url('uploads/' . $book['pdf_file']); ?>" target="_blank">View PDF</a>
                    </td>
                   
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

     


        
    </section>

    <footer>
       
    </footer>



   

</body>
</html>
