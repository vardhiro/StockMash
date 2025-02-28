<?php
$filename = "data.txt";
$symbolToUp = $_GET['win'];
$symbolToDown = $_GET['lose'];
$opinion = $_GET['opinion'];

// Read the file into an array
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$updated = false;
$updated2 = false;

// Loop through each line and update if the symbol matches
foreach ($lines as $index => $line) {
    // Explode using "." without spaces, then trim each part
    $parts = array_map('trim', explode(".", $line, 3));

    // Ensure that we have exactly three parts
    if (count($parts) !== 3) {
        continue; // Skip malformed lines
    }

    // Update the count for the stock that should increase
    if (strcasecmp($parts[0], $symbolToUp) === 0) {
        $num = (int)$parts[2];
        $num += $opinion;
        $lines[$index] = "{$parts[0]} . {$parts[1]} . {$num}";
        $updated = true;
    }

    // Update the count for the stock that should decrease
    if (strcasecmp($parts[0], $symbolToDown) === 0) {
        $num = (int)$parts[2];
        $num -= $opinion;
        $lines[$index] = "{$parts[0]} . {$parts[1]} . {$num}";
        $updated2 = true;
    }
}

// If updated, write back to file
if ($updated && $updated2) {
    file_put_contents($filename, implode("\n", $lines) . "\n");
    echo "Stock $symbolToUp and $symbolToDown updated successfully!";
} else {
    echo "Stock symbol $symbolToUp or $symbolToDown not found!";
}
?>
