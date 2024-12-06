<?php
session_start();

// Authenticate user (ensure they are logged in as a regular user)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header('Location: login.php');
    exit;
}

// Simulated cars data (replace with actual retrieval from files or a database)
$cars = [
    ['id' => 1, 'name' => 'Toyota Corolla', 'year' => 2020, 'miles' => 15000, 'color' => 'Red', 'type' => 'Sedan', 'drivetrain' => 'FWD', 'price' => 20000, 'transmission' => 'Automatic', 'features' => ['Bluetooth', 'Air Conditioning']],
    ['id' => 2, 'name' => 'Honda Civic', 'year' => 2021, 'miles' => 10000, 'color' => 'Blue', 'type' => 'Sedan', 'drivetrain' => 'FWD', 'price' => 22000, 'transmission' => 'Manual', 'features' => ['Bluetooth', 'Sunroof']],
    ['id' => 3, 'name' => 'Ford Mustang', 'year' => 2019, 'miles' => 30000, 'color' => 'Black', 'type' => 'Coupe', 'drivetrain' => 'RWD', 'price' => 35000, 'transmission' => 'Automatic', 'features' => ['Leather Seats', 'Bluetooth']],
    // More cars here...
];

// Handle filtering
$filtered_cars = $cars; // Default to all cars, apply filters below if provided

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['filter'])) {
        $filter_year = $_GET['year'] ?? '';
        $filter_color = $_GET['color'] ?? '';
        $filter_type = $_GET['type'] ?? '';
        $filter_drivetrain = $_GET['drivetrain'] ?? '';
        $filter_min_miles = $_GET['min_miles'] ?? 0;
        $filter_max_miles = $_GET['max_miles'] ?? 1000000;
        $filter_min_price = $_GET['min_price'] ?? 0;
        $filter_max_price = $_GET['max_price'] ?? 1000000;
        $filter_transmission = $_GET['transmission'] ?? '';

        // Apply filters
        $filtered_cars = array_filter($cars, function ($car) use ($filter_year, $filter_color, $filter_type, $filter_drivetrain, $filter_min_miles, $filter_max_miles, $filter_min_price, $filter_max_price, $filter_transmission) {
            return (
                (!$filter_year || $car['year'] == $filter_year) &&
                (!$filter_color || $car['color'] == $filter_color) &&
                (!$filter_type || $car['type'] == $filter_type) &&
                (!$filter_drivetrain || $car['drivetrain'] == $filter_drivetrain) &&
                ($car['miles'] >= $filter_min_miles && $car['miles'] <= $filter_max_miles) &&
                ($car['price'] >= $filter_min_price && $car['price'] <= $filter_max_price) &&
                (!$filter_transmission || $car['transmission'] == $filter_transmission)
            );
        });
    }

    // Pagination logic
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $cars_per_page = 5;
    $total_cars = count($filtered_cars);
    $total_pages = ceil($total_cars / $cars_per_page);
    $start_index = ($page - 1) * $cars_per_page;
    $paged_cars = array_slice($filtered_cars, $start_index, $cars_per_page);
}
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h2>

<!-- Filter Form -->
<form method="GET" action="">
    <h3>Filter Cars</h3>
    
    <!-- Existing Filters -->
    <label for="year">Year:</label>
    <select name="year" id="year">
        <option value="">All Years</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
    </select><br><br>

    <label for="color">Color:</label>
    <select name="color" id="color">
        <option value="">All Colors</option>
        <option value="Red">Red</option>
        <option value="Blue">Blue</option>
    </select><br><br>

    <label for="type">Type:</label>
    <select name="type" id="type">
        <option value="">All Types</option>
        <option value="Sedan">Sedan</option>
        <option value="SUV">SUV</option>
        <option value="Truck">Truck</option>
    </select><br><br>

    <label for="drivetrain">Drivetrain:</label>
    <select name="drivetrain" id="drivetrain">
        <option value="">All Drivetrains</option>
        <option value="FWD">FWD</option>
        <option value="AWD">AWD</option>
        <option value="RWD">RWD</option>
    </select><br><br>

    <!-- New Filters -->
    <label for="transmission">Transmission:</label>
    <select name="transmission" id="transmission">
        <option value="">All Transmissions</option>
        <option value="Automatic">Automatic</option>
        <option value="Manual">Manual</option>
    </select><br><br>

    <label for="min_price">Min Price:</label>
    <input type="number" name="min_price" id="min_price" value="0"><br><br>

    <label for="max_price">Max Price:</label>
    <input type="number" name="max_price" id="max_price" value="1000000"><br><br>

    <label for="min_miles">Min Miles:</label>
    <input type="number" name="min_miles" id="min_miles" value="0"><br><br>

    <label for="max_miles">Max Miles:</label>
    <input type="number" name="max_miles" id="max_miles" value="1000000"><br><br>

    <button type="submit" name="filter">Apply Filters</button>
</form>

<h3>Your Car Reviews</h3>
<!-- Show car reviews (assuming they are fetched or stored per user) -->

<h3>Filtered Cars</h3>
<!-- Display filtered cars with pagination -->
<?php if (count($paged_cars) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Year</th>
                <th>Miles</th>
                <th>Color</th>
                <th>Type</th>
                <th>Drivetrain</th>
                <th>Price</th>
                <th>Transmission</th>
                <th>Features</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paged_cars as $car): ?>
            <tr>
                <td><?php echo htmlspecialchars($car['name']); ?></td>
                <td><?php echo $car['year']; ?></td>
                <td><?php echo $car['miles']; ?> miles</td>
                <td><?php echo $car['color']; ?></td>
                <td><?php echo $car['type']; ?></td>
                <td><?php echo $car['drivetrain']; ?></td>
                <td>$<?php echo number_format($car['price'], 2); ?></td>
                <td><?php echo $car['transmission']; ?></td>
                <td><?php echo implode(', ', $car['features']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p>No cars match your filters.</p>
<?php endif; ?>

<!-- Admin Functionality for Adding Filters -->
<?php if ($_SESSION['user']['role'] === 'admin'): ?>
    <h3>Manage Filters</h3>
    <form method="POST" action="admin_filters.php">
        <label for="filter_name">Filter Name:</label>
        <input type="text" name="filter_name" id="filter_name" required><br><br>

        <label for="filter_values">Filter Values (comma-separated):</label>
        <input type="text" name="filter_values" id="filter_values" required><br><br>

        <button type="submit" name="add_filter">Add Filter</button>
    </form>
<?php endif; ?>
