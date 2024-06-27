<?php
// Include your database connection file
require 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Design</title>
    <link rel="stylesheet" href="./css/product_List.css">
</head>

<body>
    <header>
        <?php require 'navbar.php'; ?>
        <img src="./image/logo.jpeg" style="height: 150px; width: 200px; padding-left: 43%;" alt="Logo">
    </header>
    <div id="filter-container">
        <h2>You can select your preferences from here:</h2>
        <form id="filter-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="Colors">Colors:</label>





            <select id="Colors" name="Colors">
                <option value="">All</option>
                <?php
                $product_id = $_GET['product_id'];
                $sql = "SELECT * FROM color";
                // Execute the SQL query
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
                ?>
            </select>


            <label for="price">Price Range:</label>
            <select id="price" name="price">
                <option value="">All</option>
                <option value="2000-5000">3000 SR-5000 SR</option>
                <option value="5000-10000">5000 SR-10,000 SR</option>
                <option value="10000-30000">10,000 SR-50,000 SR</option>
            </select>
            <?php if (isset($_GET['product_id'])) {

                $product_id= $_GET['product_id'];
                echo '<input type="hidden" value="' . $_GET['product_id'] . '" name="product_id">';
            }

            if (isset($_POST['product_id'])) {
                echo '<input type="hidden" value="' . $_POST['product_id'] . '" name="product_id" >';
                $product_id= $_POST['product_id'];
            }



            ?>
            <button type="submit" name="submit">Apply Filter</button>
            <button type="button" onclick="resetFilters()">Reset</button>
        </form>
    </div>
    <div id="results-container">
        <h2>Filtered Results</h2>
        <div id="filtered-results">
            <?php
            // Include your database connection file
            require 'config.php';
            if (isset($_GET['product_id'])) {
                // Fetch products from the database and display them
               
                $sql = "SELECT * FROM product WHERE CategoryID = '$product_id'";
                // Execute the SQL query
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="gallery">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<fieldset>';
                        echo '<a href="product_details.php?product_id=' . $row['ProductID'] . '">';
                        echo '<img src="./image/' . $row['ProImage'] . '" alt="' . $row['ProductName'] . '">';
                        echo '<h5 style="background-color: rgb(246, 239, 230);">Price: ' . $row['ProductPrice'] . '</h5>';
                        echo '</a>';
                        echo '</fieldset>';
                    }
                    echo '</div>';
                } else {
                    echo "<p>No products found.</p>";
                }

                // Close the database connection
                $conn->close();
            }
            // Check if the form was submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                $sql = "SELECT * FROM product WHERE 1";
                // Check if Colors and price are set in the form data
                if (isset($_POST['Colors']) && isset($_POST['price'])) {
                    // Sanitize and validate the input
                    $selectedColor = $_POST['Colors'];
                    $priceRange = $_POST['price'];

                    // Modify the SQL query based on the selected filters
                    if (!empty($selectedColor)) {
                        $sql .= " AND PrColor = '$selectedColor'"; // Append color filter to the query
                    }
                    if (!empty($priceRange)) {
                        list($minPrice, $maxPrice) = explode('-', $priceRange);
                      
                        $sql .= " AND ProductPrice BETWEEN $minPrice AND $maxPrice"; // Append price range filter
                    }

                    $sql.=" AND CategoryID = '$product_id'";
                    // Execute the SQL query
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo '<div class="gallery">';
                        while ($row = $result->fetch_assoc()) {
                            echo '<fieldset>';
                            echo '<a href="product_details.php?product_id=' . $row['ProductID'] . '">';
                            echo '<img src="./image/' . $row['ProImage'] . '" alt="' . $row['ProductName'] . '">';
                            echo '<h5 style="background-color: rgb(246, 239, 230);">Price: ' . $row['ProductPrice'] . '</h5>';
                            echo '</a>';
                            echo '</fieldset>';
                        }
                        echo '</div>';
                    } else {
                        echo "<p>No products found.</p>";
                    }
                    // Close the database connection
                    $conn->close();
                }
            }
            ?>
        </div>
    </div>
</body>
</html>