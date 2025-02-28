<?php
if (count($data) >= 10) {
    // Get 10 random keys
    $randomKeys = array_rand($data, 10);
    
    // Fetch the corresponding elements
    $randomElements = array_map(function($key) use ($data) {
        return $data[$key];
    }, $randomKeys);
    
    // Print the random elements
} else {
    echo "Not enough elements to pick 10.";
}
?>
