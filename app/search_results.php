<?php
session_start();

// Authenticate user (ensure they are logged in as admin or regular user)
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$search_query = '';
$search_results = [];

if (isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Simulate searching for cars (replace this with actual search logic)
    // Example: $search_results = searchCars($search_query);
    $cars = [
        ['id' => 1, 'name' => 'Toyota Corolla', 'year' => 2020, 'description' => 'Compact and reliable.'],
        ['id' => 2, 'name' => 'Honda Civic', 'year' => 2021, 'description' => 'Fuel-efficient and stylish.'],
    ];

    $search_results = array_filter($cars, function ($car) use ($search_query) {
        return strpos(strtolower($car['name']), strtolower($search_query)) !== false;
    });
}

?>
<h2>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h2>
<?php if (count($search_results) > 0): ?>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Year</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($search_results as $car): ?>
        <tr>
            <td><?php echo htmlspecialchars($car['name']); ?></td>
            <td><?php echo $car['year']; ?></td>
            <td><?php echo htmlspecialchars($car['description']); ?></td>
            <td><a href="car_detail.php?id=<?php echo $car['id']; ?>">View</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No cars found.</p>
<?php endif; ?>
