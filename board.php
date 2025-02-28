<?php
// Read the file
$filename = "data.txt";
$data = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$stocks = [];

// Parse the file
foreach ($data as $line) {
    $parts = explode(" . ", $line);
    if (count($parts) >= 3) {
        $symbol = trim($parts[0]);
        $name = trim($parts[1]);
        $points = floatval(trim($parts[2]));
        $stocks[] = ["symbol" => $symbol, "name" => $name, "points" => $points];
    }
}

// Sort the stocks by points in descending order
usort($stocks, function ($a, $b) {
    return $b["points"] <=> $a["points"];
});

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Leaderboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            background: #1e1e1e;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #ffcc00;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #333;
        }
        th {
            background-color: #ffcc00;
            color: #121212;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #2a2a2a;
        }
        tr:hover {
            background-color: #ffcc00;
            color: #121212;
            transition: 0.3s;
        }
        .table-wrapper {
            max-height: 70vh;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>RankBoard: 📈 What players think of a stock</h2>
        <div class="table-wrapper">
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Symbol</th>
                    <th>Company Name</th>
                    <th>Points</th>
                </tr>
                <?php $rank = 1; ?>
                <?php foreach ($stocks as $stock): ?>
                    <tr>
                        <td><?= $rank++ ?></td>
                        <td><?= htmlspecialchars($stock["symbol"]) ?></td>
                        <td><?= htmlspecialchars($stock["name"]) ?></td>
                        <td><?= htmlspecialchars($stock["points"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
