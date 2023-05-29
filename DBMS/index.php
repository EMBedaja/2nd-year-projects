<!DOCTYPE html>
<html>
<head>
  <title>Best Inventory</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Header -->
  <div id="company">
    <h1>Best Inventory</h1>
    <h3>"Better than Super Inventory"</h3>
  </div>

  <!-- Navigation -->
  <div id="nav">
    <ul>
      <li><a href="index.php?page=add_stock">Menu</a></li> <!-- Link to add_stock page -->
      <li><a href="index.php?page=add_stock">Stock</a></li> <!-- Link to add_stock page -->
      <li><a href="index.php?page=category">Category</a></li> <!-- Link to category page -->
      <li><a href="index.php?page=inventory">Stock Inventory</a></li> <!-- Link to inventory page -->
      <li><a href="index.php?page=receiving">Receiving</a></li> <!-- Link to receiving page -->
      <li><a href="index.php?page=releasing">Releasing</a></li> <!-- Link to releasing page -->
      <li><a href="index.php?page=delete">Delete Record</a></li> <!-- Link to delete page -->
    </ul>
  </div>

  <!-- Content -->
  <div id="content">
    <?php
      $host = "localhost"; 
      $user = "root"; 
      $pass = ""; 
      $connect = @mysqli_connect($host, $user, $pass) or die("Unable to connect to host"); // Connect to MySQL host

      $db = @mysqli_select_db($connect, "inventory") or die("Unable to connect to Database"); // Select the "inventory" database




//add stock
if (!isset($_GET['page']) || $_GET['page'] === 'add_stock') { // Checking if the 'page' parameter is not set or set to 'add_stock'
  $sql = "SELECT * FROM category"; // Query to fetch all categories from the database
  $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table"); // Executing the SQL query and storing the result

  echo '
  <h2>Add Stock</h2>
  <hr><br>
  <form method="POST" action="">
    <label for="code">Code:</label> 
    <br>
    <input type="number" name="code" id="code" required><br><br> 
    <label for="stockName">Stock Name:</label><br>
    <input type="text" name="stockName" id="stockName" required><br><br> 
    <label for="expirationDate">Expiration Date:</label><br>
    <input type="date" name="expirationDate" id="expirationDate" required style="height:30px"><br><br> 
    <label for="category">Category:</label><br>
    <select name="category" id="category" style="height:30px">
    ';

  while ($row = mysqli_fetch_assoc($dbrecords)) { // Looping through each fetched category
    $categoryName = $row['category_name'];
    echo "<option value='$categoryName'>$categoryName</option>"; // Adding each category as an option in the select dropdown
  }

  echo '
    </select ><a href="index.php?page=del_category" style="color:#034B8D;" > &nbsp; Delete Category</a><br><br> 
    <label for="count">Count:</label><br>
    <input type="number" name="count" id="count" required><br><br> 
    <input type="reset" value="Clear"> 
    <input type="submit" name="submit_new" value="Submit"> 

  </form>';

  if (isset($_POST['submit_new'])) { // Checking if the form was submitted
    $code = $_POST['code']; // Getting the submitted stock code
    $stockName = $_POST['stockName']; // Getting the submitted stock name
    $expirationDate = $_POST['expirationDate']; // Getting the submitted expiration date
    $category = $_POST['category']; // Getting the submitted category
    $count = $_POST['count']; // Getting the submitted stock count

    $sql = "INSERT INTO stock (code, stock_name, expiration_date, category, count) VALUES ('$code', '$stockName', '$expirationDate', '$category', '$count')"; // SQL query to insert the stock into the database. Fix: Enclose string values in single quotes

    $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table"); // Executing the SQL query and storing the result

    if ($dbrecords) {
      echo "Stock added successfully."; // Outputting success message if the stock was added
    } else {
      echo "Error adding stock."; // Outputting error message if the stock couldn't be added
    }
  }
}


//category page
elseif (isset($_GET['page']) && $_GET['page'] === 'category') { // Checking if the 'page' parameter is set to 'category'
  echo '
  <h2>Add Category</h2>
  <hr><br>
  <form method="POST" action="">
    <label for="categoryName">Category Name:</label><br>
    <input type="text" name="categoryName" id="categoryName" required><br><br>
    <label for="description">Description:</label><br>
    <input type="text" name="description" id="description" required><br><br> 
    <input type="reset" value="Clear"> 
    <input type="submit" name="submit_category" value="Submit"> 
   
  </form>';

  if (isset($_POST['submit_category'])) { // Checking if the form was submitted
    $categoryName = $_POST['categoryName']; // Getting the submitted category name
    $description = $_POST['description']; // Getting the submitted category description

    $sql = "INSERT INTO category (category_name, `desc`) VALUES ('$categoryName', '$description')"; // SQL query to insert the category into the database
    $dbrecords = @mysqli_query($connect, $sql) or die("Unable to connect to Table"); // Executing the SQL query and storing the result

    if ($dbrecords) {
      echo "Category added successfully."; // Outputting success message if the category was added
    } else {
      echo "Error adding category."; // Outputting error message if the category couldn't be added
    }
  }
}

//inventory page
elseif (isset($_GET['page']) && $_GET['page'] === 'inventory') {
  $sql = "SELECT code, stock_name, expiration_date, category, count FROM stock";
  $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");

  echo "<h2>Stock Inventory</h2> <hr> <br>";
  echo "<table border='1'><tr><td>Code</td><td>Name</td><td>Category</td><td>Expiry Date</td><td>Count</td><td>Receiving</td><td>Releasing</td></tr>";
  while ($row = mysqli_fetch_assoc($dbrecords)) {
    echo "<td><form method='POST' action='index.php?page=update'>"; // Update the form's action to 'update.php'
    echo "<input type='hidden' name='page' value='update'>"; // Hidden input field for the page value
    echo "<input type='hidden' name='code' value='" .urlencode($row['code']) . "'>"; // Hidden input field containing the code value
    echo "<input type='submit' style='color:#AB0000;background:none;border:none;font-weight:bolder;' name='code' value=' " .urlencode($row['code'])."' >";
    echo "</form></td>";       
    echo "<td>".$row['stock_name']."</td>";
    echo "<td>".$row['category']."</td>";
    echo "<td>".$row['expiration_date']."</td>";
    echo "<td>".$row['count']."</td>";
    echo "<td><a href='index.php?page=receive&code=".urlencode($row['code'])."' >ADD</a></td>";
    echo "<td><a href='index.php?page=release&code=".urlencode($row['code'])."'>DEDUCT</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}


//update stock
elseif (isset($_GET['page']) && $_GET['page'] === 'update') {
  // Check if the 'code' parameter is set and not empty
  if (isset($_POST['code']) && !empty($_POST['code'])) {
    $code = urldecode($_POST['code']); // Get the decoded code value from $_POST

    // Retrieve the stock information based on the provided code
    $sql = "SELECT code, stock_name, expiration_date, category, count FROM stock WHERE code = '$code'";
    $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");
    $row = mysqli_fetch_assoc($dbrecords);

    if (!$row) {
      echo "Stock not found.";
    } else {
      echo "<h2>Update Stock</h2> <hr> <br>";
      echo "<form method='POST' action=''>";
      echo "<label for='code'>Code:</label><br>";
      echo "<input type='text' name='code' id='code' value='$code' readonly><br><br>"; // Display the code in a readonly input field
      echo "<label for='stockName'>Stock Name:</label><br>";
      echo "<input type='text' name='stockName' id='stockName' value='".$row['stock_name']."' required><br><br>"; // Display the stock name in an editable input field
      echo "<label for='expirationDate'>Expiration Date:</label><br>";
      echo "<input type='date' name='expirationDate' id='expirationDate' value='".$row['expiration_date']."' required><br><br>"; // Display the expiration date in an editable input field
      echo "<label for='category'>Category:</label><br>";
      echo "<select name='category' id='category' required>"; 
      $categorySql = "SELECT * FROM category"; 
      $categoryRecords = mysqli_query($connect, $categorySql) or die("Unable to connect to Table");
      while ($categoryRow = mysqli_fetch_assoc($categoryRecords)) {
        $selected = ($categoryRow['category_name'] === $row['category']) ? "selected" : ""; 
        echo "<option value='".$categoryRow['category_name']."' $selected>".$categoryRow['category_name']."</option>"; 
      }
      echo "</select><br><br>";
      echo "<label for='count'>Count:</label><br>";
      echo "<input type='number' name='count' id='count' value='".$row['count']."' required><br><br>"; // Display the count in an editable input field
      echo "<input type='reset' value='Clear'> &nbsp; "; 
      echo "<input type='submit' name='submit_up' value='Submit'>";
      echo "</form>";
    }
  }

  if (isset($_POST['submit_up'])) {
    $stockName = $_POST['stockName'];
    $expirationDate = $_POST['expirationDate'];
    $category = $_POST['category'];
    $count = $_POST['count'];

    // Update the stock information in the database
    $sql = "UPDATE stock SET stock_name = '$stockName', expiration_date = '$expirationDate', category = '$category', count = '$count' WHERE code = '$code'";
    $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");
    
        if ($dbrecords) {
          echo "Stock updated successfully.";
          echo "<script>";
          echo "if (!window.location.hash) {";
          echo "  window.location = window.location + '#loaded';";
          echo "  window.location.reload();";
          echo "}";
          echo "</script>";
        }        
         else {
          echo "Error updating stock.";
        }
      }
    }


//receive page
elseif (isset($_GET['page']) && $_GET['page'] === 'receive') {
  // Check if the 'code' parameter is set and not empty
  if (isset($_GET['code']) && !empty($_GET['code'])) {
    $code = urldecode($_GET['code']); // Get the decoded code value from $_GET

    // Retrieve the stock information based on the provided code
    $sql = "SELECT code, stock_name, count FROM stock WHERE code = '$code'";
    $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");
    $row = mysqli_fetch_assoc($dbrecords);

    if (!$row) {
      echo "Stock not found.";
    } else {
      echo "<h2>Receive Stock</h2> <hr> <br>";
      echo "<form method='POST' action=''>";
      echo "<label for='code'>Code:</label>";
      echo "<input type='text' name='code' id='code' value='$code' readonly><br><br>"; // Display the code in a readonly input field
      echo "<label for='stockName'>Stock Name:</label>";
      echo "<input type='text' name='stockName' id='stockName' value='".$row['stock_name']."' readonly><br><br>"; // Display the stock name in a readonly input field
      echo "<label for='currentStock'>Current Stock:</label>";
      echo "<input type='text' name='currentStock' id='currentStock' value='".$row['count']."' readonly><br><br>"; // Display the current stock in a readonly input field
      echo "<label for='receiveNumber'>RCS Number:</label>";
      echo "<input type='text' name='receiveNumber' id='receiveNumber' required><br><br>"; // Input field for receive number
      echo "<label for='supplierName'>Supplier Name:</label>";
      echo "<input type='text' name='supplierName' id='supplierName' required><br><br>"; // Input field for supplier name
      echo "<label for='supplierAddress'>Supplier Address:</label>";
      echo "<input type='text' name='supplierAddress' id='supplierAddress' required><br><br>"; // Input field for supplier address
      echo "<label for='receiveDate'>RCS Date:</label>";
      echo "<input type='date' name='receiveDate' id='receiveDate' required><br><br>"; // Input field for receive date
      echo "<label for='quantity'>Quantity to Add:</label>";
      echo "<input type='number' name='quantity' id='quantity' required><br><br>"; // Input field for quantity
      echo "<input type='reset' value='Clear'>";
      echo "<input type='submit' name='submit' value='Submit' >";
      echo "</form>";
    }
  }
}

if (isset($_POST['submit'])) {
  $receiveNumber = $_POST['receiveNumber'];
  $supplierName = $_POST['supplierName'];
  $supplierAddress = $_POST['supplierAddress'];
  $receiveDate = $_POST['receiveDate'];
  $quantity = $_POST['quantity'];
  $currentStock = $row['count'];
  $stockName = $row['stock_name'];

  // Calculate new stock count
  $newStockCount = $currentStock + $quantity;

  // Update the stock information in the database
  $sql = "UPDATE stock SET count = '$newStockCount' WHERE code = '$code'";
  $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");

  if ($dbrecords) {
    // Insert the receiving information into the receiving table
    $sql = "INSERT INTO RCS (RCSCode, supplier_name, supplier_add, current_stock, quantity, new_count, rcs_date, stock_code, stock_name) VALUES ('$receiveNumber', '$supplierName', '$supplierAddress', '$currentStock', '$quantity', '$newStockCount', '$receiveDate', '$code', '$stockName')";
    $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");

    if ($dbrecords) {
      echo "Stock received successfully.";
    } else {
      echo "Error receiving stock.";
    }
  }
}



///release page
elseif (isset($_GET['page']) && $_GET['page'] === 'release') {
  // Check if the 'code' parameter is set and not empty
  if (isset($_GET['code']) && !empty($_GET['code'])) {
    $code = urldecode($_GET['code']); // Get the decoded code value from $_GET

    // Retrieve the stock information based on the provided code
    $sql = "SELECT code, stock_name, count FROM stock WHERE code = '$code'";
    $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");
    $row = mysqli_fetch_assoc($dbrecords);

    if (!$row) {
      echo "Stock not found.";
    } else {
      echo "<h2>Release Stock</h2>";
      echo "<form method='POST' action=''>";
      echo "<label for='code'>Code:</label>";
      echo "<input type='text' name='code' id='code' value='$code' readonly><br><br>"; // Display the code in a readonly input field
      echo "<label for='stockName'>Stock Name:</label>";
      echo "<input type='text' name='stockName' id='stockName' value='".$row['stock_name']."' readonly><br><br>"; // Display the stock name in a readonly input field
      echo "<label for='currentStock'>Current Stock:</label>";
      echo "<input type='text' name='currentStock' id='currentStock' value='".$row['count']."' readonly><br><br>"; // Display the current stock in a readonly input field
      echo "<label for='releaseNumber'>RLS Number:</label>";
      echo "<input type='text' name='releaseNumber' id='releaseNumber' required><br><br>"; // Input field for release number
      echo "<label for='SupplierName'>Supplier Name:</label>";
      echo "<input type='text' name='supplierName' id='supplierName' required><br><br>"; // Input field for supplier name
      echo "<label for='supplierAddress'>Supplier Address:</label>";
      echo "<input type='text' name='supplierAddress' id='supplierAddress' required><br><br>";      // Input field for supplier address      
      echo "<label for='releaseDate'>RLS Date:</label>";
      echo "<input type='date' name='releaseDate' id='releaseDate' required><br><br>"; // Input field for release date
      echo "<label for='quantity'>Quantity to Deduct:</label>";
      echo "<input type='number' name='quantity' id='quantity' required><br><br>"; // Input field for quantity
      echo "<input type='reset' value='Clear'>";
      echo "<input type='submit' name='releaseSubmit' value='Submit' >";
      echo "</form>";
    }
  }
}
if (isset($_POST['releaseSubmit'])) {
  $releaseNumber = $_POST['releaseNumber'];
  $supplierName = $_POST['supplierName'];
  $supplierAddress = $_POST['supplierAddress'];
  $releaseDate = $_POST['releaseDate'];
  $quantity = $_POST['quantity'];
  $currentStock = $row['count'];
  $stockName = $row['stock_name'];

  // Calculate new stock count
  $newStockCount = $currentStock - $quantity;

  // Update the stock information in the database
  $sql = "UPDATE stock SET count = '$newStockCount' WHERE code = '$code'";
  $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");

  if ($dbrecords) {
    // Insert the release information into the release table
    $sql = "INSERT INTO RLS (RLSCode, supplier_name, supplier_add, current_stock, quantity, new_count, RLS_date, stock_code, stock_name) VALUES ('$releaseNumber', '$supplierName', '$supplierAddress', '$currentStock', '$quantity', '$newStockCount', '$releaseDate', '$code', '$stockName')";
    $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");

    if ($dbrecords) {
      echo "Stock released successfully.";
    } else {
      echo "Error releasing stock.";
    }
  }
}

//RCV table page
elseif (isset($_GET['page']) && $_GET['page'] === 'receiving') {
  $sql = "SELECT * FROM RCS";
  $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");
  echo "<h2>Receiving Table</h2> <hr> <br>";
  echo "<table border='1'><tr><td>RCS Code</td><td>Supplier Name</td><td>Supplier Address</td><td>Current Stock</td><td>Quantity</td><td>New Count</td><td>RCS Date</td> <td>Stock Code</td><td>Stock Name</td></tr>";
  while ($row = mysqli_fetch_assoc($dbrecords)) {      
    echo "<td>".$row['RCSCode']."</td>";
    echo "<td>".$row['supplier_name']."</td>";
    echo "<td>".$row['supplier_add']."</td>";
    echo "<td>".$row['current_stock']."</td>";
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$row['new_count']."</td>";
    echo "<td>".$row['RCS_date']."</td>";
    echo "<td>".$row['stock_code']."</td>";
    echo "<td>".$row['stock_name']."</td>";
    echo "</tr>";
  }
  echo "</table>";
}

//RLS table page
elseif (isset($_GET['page']) && $_GET['page'] === 'releasing') {
  $sql = "SELECT * FROM RLS";
  $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");
  echo "<h2>Releasing Table</h2> <hr> <br>";
  echo "<table border='1'><tr><td>RLS Code</td><td>Supplier Name</td><td>Supplier Address</td><td>Current Stock</td><td>Quantity</td><td>New Count</td><td>RLS Date</td> <td>Stock Code</td><td>Stock Name</td></tr>";
  while ($row = mysqli_fetch_assoc($dbrecords)) {      
    echo "<td>".$row['RLSCode']."</td>";
    echo "<td>".$row['supplier_name']."</td>";
    echo "<td>".$row['supplier_add']."</td>";
    echo "<td>".$row['current_stock']."</td>";
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$row['new_count']."</td>";
    echo "<td>".$row['RLS_date']."</td>";
    echo "<td>".$row['stock_code']."</td>";
    echo "<td>".$row['stock_name']."</td>";
    echo "</tr>";
  }
  echo "</table>";
}







    

// Delete category page
elseif (isset($_GET['page']) && $_GET['page'] === 'del_category') {
  $sql = "SELECT category_name, `desc` FROM category";
  $dbrecords = mysqli_query($connect, $sql) or die("Unable to connect to Table");

  echo "<h2>Delete Category</h2> <hr> <br>";
  echo "<table border='1'><tr><td>Name</td><td>Description</td><td>Delete</td></tr>";
  while ($row = mysqli_fetch_assoc($dbrecords)) {
    echo "<tr>";
    foreach ($row as $fieldname => $value) {
      echo "<td>".$value."</td>";
    }
    echo "<td>
            <form method='post' action=''>
              <input type='hidden' name='category_name' value='".$row['category_name']."'>
              <button type='submit' name='delete_category'>x</button>
            </form>
          </td>";
    echo "</tr>";
  }
  echo "</table>";
}
if (isset($_POST['delete_category'])) {

$categoryName = $_POST['category_name'];

$sql = "DELETE FROM category WHERE category_name = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "s", $categoryName);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($connect);

  header("Location: index.php?page=del_category");
  exit();
}



  // Delete page
elseif (isset($_GET['page']) && $_GET['page'] === 'delete') {
  echo '
  <h2>Delete Data</h2> <hr> <br>
  <form method="POST" action="">
      <label for="code">Code:</label><br>
      <input type="number" name="code" id="code">
      <input type="submit" name="submit1" value="Delete"><br><br>
      <label for="rcsNum">RCS Number:</label><br>
      <input type="text" name="rcsNum" id="rcsNum">
      <input type="submit" name="submit2" value="Delete"><br><br>
      <label for="rlsNum">RLS Number:</label><br>
      <input type="text" name="rlsNum" id="rlsNum">
      <input type="submit" name="submit3" value="Delete"><br><br>
  </form>';
}

// Delete from stock table
if (isset($_POST['submit1'])) {
  $code = $_POST['code'];
  $stockDeleteQuery = "DELETE FROM stock WHERE code = ?";
  $stmt = mysqli_prepare($connect, $stockDeleteQuery);
  mysqli_stmt_bind_param($stmt, "i", $code);
  mysqli_stmt_execute($stmt);
  $deletedRows = mysqli_stmt_affected_rows($stmt);
  if ($deletedRows > 0) {
      echo "Delete query executed successfully. Affected rows: " . $deletedRows;
  } else {
      echo "No rows deleted.";
  }
  mysqli_stmt_close($stmt);
}

// Delete from receiving table
elseif (isset($_POST['submit2'])) {
  $rcsNum = $_POST['rcsNum'];
  $receivingDeleteQuery = "DELETE FROM rcs WHERE RCSCode = ?";
  $stmt = mysqli_prepare($connect, $receivingDeleteQuery);
  mysqli_stmt_bind_param($stmt, "s", $rcsNum);
  mysqli_stmt_execute($stmt);
  $deletedRows = mysqli_stmt_affected_rows($stmt);
  if ($deletedRows > 0) {
      echo "Delete query executed successfully. Affected rows: " . $deletedRows;
  } else {
      echo "No rows deleted.";
  }
  mysqli_stmt_close($stmt);
}

// Delete from releasing table
elseif (isset($_POST['submit3'])) {
  $rlsNum = $_POST['rlsNum'];
  $releasingDeleteQuery = "DELETE FROM rls WHERE RLSCode = ?";
  $stmt = mysqli_prepare($connect, $releasingDeleteQuery);
  mysqli_stmt_bind_param($stmt, "s", $rlsNum);
  mysqli_stmt_execute($stmt);
  $deletedRows = mysqli_stmt_affected_rows($stmt);
  if ($deletedRows > 0) {
      echo "Delete query executed successfully. Affected rows: " . $deletedRows;
  } else {
      echo "No rows deleted.";
  }
  mysqli_stmt_close($stmt);
}

mysqli_close($connect);

    ?>
  </div>
</body>
</html>
