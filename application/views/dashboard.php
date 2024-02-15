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
        <h2>Books</h2>
        <!-- <a href="<?php echo site_url('auth/add_book');?>" class="add-book-btn">Add New Book</a> -->
        <a href="#" class="add-book-btn" onclick="openModal()">Add New Book</a>
        <!-- Edit Book Modal -->
<div id="editBookModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Book</h2>
        <form action="<?php echo base_url('book/update_book'); ?>" method="post">
            <input type="hidden" id="edit_book_id" name="edit_book_id">
            
            <label for="edit_title">Title:</label>
            <input type="text" id="edit_title" name="edit_title" required><br>

            <label for="edit_author">Author:</label>
            <input type="text" id="edit_author" name="edit_author" required><br>

            <label for="edit_description">Description:</label>
            <input type="text" id="edit_description" name="edit_description" required><br>

            <label for="edit_date">Publication Date:</label>
            <input type="date" id="edit_date" name="edit_date" required><br>

            <label for="edit_cat">Category name:</label>
            <select id="edit_category" name="edit_category" required>

            <label for="edit_pdf">PDF File:</label>
            <input type="file" id="edit_pdff" name="edit_pdff"><span id="edit_pdf"></span>
           

            <button type="submit">Update Book</button>
        </form>
    </div>
</div>
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
                    <th>Actions</th>
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
                    <td>
                   
                    <a href="#" onclick="openEditModal('<?php echo $book['book_id']; ?>', '<?php echo $book['title']; ?>', '<?php echo $book['author']; ?>', '<?php echo $book['description']; ?>', '<?php echo $book['publication_date']; ?>', '<?php echo $book['category_name']; ?>','<?php echo  $book['pdf_file']; ?>','<?php echo $book['category_id']; ?>')" class="edit-btn">Edit</a>

                        <a href="<?php echo base_url('book/delete_book/' . $book['book_id']); ?>" class="delete-btn">Delete</a>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Add New Book</h2>
                <div id="modalErrorMessage" style="color: red;"></div>
                <!-- Your form goes here -->
                <form id="addBookForm" method="post" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required><br>

                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required><br>

                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" required><br>

                    <label for="publication_date">Publication Date:</label>
                    <input type="date" id="publication_date" name="publication_date" required><br>

                    <label for="category">Select Category</label>
                    <select id="category" name="category" required>
                    <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
    <?php endforeach; ?>
                </select>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
                
                <label for="pdf_file">PDF File (less than 1 MB):</label>
                <input type="file" id="pdf_file" name="pdf_file" accept=".pdf" required>
                
                <button type="button" onclick="submitForm()">Add Book</button>
                </form>
            </div>
        </div>


        
    </section>

    <footer>
       
    </footer>


    <script>
        // JavaScript functions for modal
        function openModal() {
           
            document.getElementById('myModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

       
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // function submitForm() {
        //     var formData = new FormData($("#addBookForm")[0]);

        //     $.ajax({
        //         url: "<?php echo base_url('book/insert_book'); ?>",
        //         type: "POST",
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         dataType: "json",
        //         success: function(response) {
        //             console.log(response);
        //             closeModal();
        //         },
        //         error: function(error) {
        //             console.error(error);
        //         }
        //     });
        // }

        function submitForm() {
    // Other form submission logic...

    $.ajax({
        url: '<?php echo base_url('book/insert_book'); ?>',
        type: 'POST',
        data: new FormData($('#addBookForm')[0]),
        processData: false,
        contentType: false,
        success: function(response) {
            var result = JSON.parse(response);

            if (result.status === 'success') {
                // Book added successfully, handle success as needed
                closeModal();
            } else if (result.status === 'error') {
                // Book addition failed, display the error message in the modal
                $('#modalErrorMessage').html(result.message);
            }
        },
        error: function(error) {
            console.error('Error submitting the form:', error);
        }
    });
}

       

       
    </script>
    <script>
    function openEditModal(bookId, title, author,description,publication_date,category_name,pdf_file,category_id) {
        document.getElementById('edit_book_id').value = bookId;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_author').value = author;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_date').value = publication_date;
        // document.getElementById('edit_cat').value = category_name;
        document.getElementById('edit_pdf').innerText = pdf_file;
        var categorySelect = document.getElementById('edit_category');
        categorySelect.innerHTML = ''; // Clear existing options

        // Add an option for the current category
        var currentCategoryOption = document.createElement('option');
        currentCategoryOption.value = category_name;
        currentCategoryOption.text = category_name;
        currentCategoryOption.selected = true; // Select the current category
        categorySelect.add(currentCategoryOption);

          // Fetch categories from the server
          $.ajax({
            url: '<?php echo base_url('book/fetch_categories'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Iterate over the received categories and add options
                for (var i = 0; i < response.length; i++) {
                    var categoryOption = document.createElement('option');
                    categoryOption.value = response[i].category_id;
                    categoryOption.text = response[i].category_name;
                    categorySelect.add(categoryOption);
                }
            },
            error: function(error) {
                console.error('Error fetching categories:', error);
            }
        });
        
       

        document.getElementById('editBookModal').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editBookModal').style.display = 'none';
    }
</script>

</body>
</html>
