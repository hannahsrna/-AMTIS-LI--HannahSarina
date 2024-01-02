<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Calculator</title>
    <!-- Bootstrap CSS link -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Electricity Calculator</h2>

    <?php
// Function to calculate electricity rates for each hour
function calculateElectricityRatesPerHour($voltage, $current, $currentRate) {
    $resultsPerHour = [];

    for ($hour = 1; $hour <= 24; $hour++) {
        // Calculate Power (in Wh) for each hour
        $power = $voltage * $current;

        // Calculate Energy (in kWh) for each hour
        $energy = $power * $hour * 0.001;

        // Calculate Total Charge for each hour
        $totalCharge = number_format($energy * ($currentRate / 100), 2);

        // Add results to the array
        $resultsPerHour[] = [
            'hour' => $hour,
            'power' => $power,
            'energy' => $energy,
            'totalCharge' => $totalCharge,
        ];
    }

    return $resultsPerHour;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $voltage = floatval($_POST['voltage']);
    $current = floatval($_POST['current']);
    $currentRate = floatval($_POST['currentRate']);

    // Calculate electricity rates for each hour
    $resultsPerHour = calculateElectricityRatesPerHour($voltage, $current, $currentRate);

    // Display results in a table
    
    echo "<div class='mt-4'>";
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Hour</th>";
    echo "<th>Power (kWh)</th>";
    echo "<th>Total (RM)</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($resultsPerHour as $result) {
        echo "<tr>";
        echo "<td>{$result['hour']}</td>";
        echo "<td>{$result['hour']}</td>";
        echo "<td>{$result['energy']} </td>";
        echo "<td>{$result['totalCharge']}</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}
?>


    <!-- Form for user input -->
    <form method="post" class="mt-4">
        <div class="form-group">
            <label for="voltage">Voltage (V):</label>
            <input type="float" step="any" class="form-control" id="voltage" name="voltage" required>
        </div>
        <div class="form-group">
            <label for="current">Current (A):</label>
            <input type="float" step="any" class="form-control" id="current" name="current" required>
        </div>
        <div class="form-group">
            <label for="currentRate">Current Rate (per kWh):</label>
            <input type="float" step="any" class="form-control" id="currentRate" name="currentRate" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>
</div>

</body>
</html>