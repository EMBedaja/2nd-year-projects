<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_wbapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// Fetch the distinct years from the orders
$years_sql = "SELECT DISTINCT YEAR(ord_date_added) as year FROM tbl_orders";
$year_result = $conn->query($years_sql);

?>


<div class="header">
  <h3>Sales Chart</h3>
</div>

<div style="margin-left: 210px;">
  <!-- Create a form to select year -->
  <form method="post" action="">
    <select name="year">
      <?php while ($row = $year_result->fetch_assoc()) : ?>
        <option value="<?php echo $row['year'] ?>"><?php echo $row['year'] ?></option>
      <?php endwhile; ?>
    </select>
    <button type="submit">Submit</button>
  </form>

  <?php

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected year
    $selected_year = $_POST['year'];

    // Prepare the sql statement
    $sql = "
  SELECT MONTH(o.ord_date_added) as month, SUM(p.prod_price * oi.ord_qty) as total_sale 
  FROM tbl_orders_items oi
  INNER JOIN tbl_orders o ON oi.ord_id = o.ord_id
  INNER JOIN tbl_product p ON oi.prod_id = p.prod_id
  WHERE YEAR(o.ord_date_added) = ?
  GROUP BY MONTH(o.ord_date_added)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $selected_year);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($month, $total_sale);

    $sales_data = [
      "1" => 0,
      "2" => 0,
      "3" => 0,
      "4" => 0,
      "5" => 0,
      "6" => 0,
      "7" => 0,
      "8" => 0,
      "9" => 0,
      "10" => 0,
      "11" => 0,
      "12" => 0
    ];

    // Fetch the data
    while ($stmt->fetch()) {
      $sales_data[$month] = $total_sale;
    }

    // Close the statement
    $stmt->close();
  }

  // Close the connection
  $conn->close();
  ?>

  <canvas id="salesChart" style="width: 100%;"></canvas>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var sales_data = <?php echo json_encode($sales_data); ?>;
  console.log(sales_data);
  var salesChart = new Chart(document.getElementById('salesChart').getContext('2d'), {
    type: 'bar',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        label: '# of Sales',
        data: Object.values(sales_data),
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>