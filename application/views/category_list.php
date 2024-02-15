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
    </style>
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
        <h2>Categories</h2>
        <a href="#" class="add-book-btn" onclick="openAddCategoryModal()">Add New Category</a>
        <div id="addCategoryModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddCategoryModal()">&times;</span>
        <h2>Add New Category</h2>
        <form id="addCatForm" action="" method="post">
            <label for="category_name">Category Name:</label>
            <input type="text" id="category_name" name="category_name" required>
            <button type="submit" onclick="submitForm()">Add Category</button>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditCategoryModal()">&times;</span>
        <h2>Edit Category</h2>
        <form action="<?php echo base_url('book/edit_category'); ?>" method="post">
            <input type="hidden" id="edit_category_id" name="edit_category_id">
            <label for="edit_category_name">Category Name:</label>
            <input type="text" id="edit_category_name" name="edit_category_name" required>
            <button type="submit">Update Category</button>
        </form>
    </div>
</div>

        <!-- Table for Book Information -->
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($cat as $catg): ?>
                <tr>
                    <td><?php echo $catg['category_name']; ?></td>
                    <td>
                   
                    <a href="#" onclick="openEditCategoryModal('<?php echo $catg['category_id']; ?>', '<?php echo $catg['category_name']; ?>')" class="edit-btn">Edit</a>
                    <a href="<?php echo base_url('book/delete_category/' . $catg['category_id']); ?>" class="delete-btn">Delete</a>
                    
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

       


        
    </section>

    <footer>
       
    </footer>


   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
       
       function openAddCategoryModal() {
    document.getElementById('addCategoryModal').style.display = 'block';
}

function closeAddCategoryModal() {
    document.getElementById('addCategoryModal').style.display = 'none';
}
function submitForm() {
            var formData = new FormData($("#addCatForm")[0]);

            $.ajax({
                url: "<?php echo base_url('book/insert_category'); ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    closeModal();
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
        
        function openEditCategoryModal(categoryId, categoryName) {
    document.getElementById('edit_category_id').value = categoryId;
    document.getElementById('edit_category_name').value = categoryName;
    document.getElementById('editCategoryModal').style.display = 'block';
}

function closeEditCategoryModal() {
    document.getElementById('editCategoryModal').style.display = 'none';
}   

       
    </script>
    

</body>
</html>
