<?php
$symbol = $_GET['symbol'];
$url = "https://www.nseindia.com/api/quote-equity?symbol=$symbol";

// Initialize cURL for cookie and session setup
$ch = curl_init();

// Step 1: Fetch cookies by visiting the homepage first
curl_setopt($ch, CURLOPT_URL, 'https://www.nseindia.com/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'nse_cookies.txt'); // Save cookies
curl_setopt($ch, CURLOPT_COOKIEJAR, 'nse_cookies.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL verification (if needed)

// Critical headers to mimic a browser
$headers = [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Language: en-US,en;q=0.9',
    'Connection: keep-alive',
    'Host: www.nseindia.com',
    'Referer: https://www.nseindia.com/'
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the homepage request to set cookies
$homepageResponse = curl_exec($ch);
if (curl_errno($ch)) {
    die("Cookie setup failed: " . curl_error($ch));
}

// Step 2: Now fetch the API endpoint with the same session
curl_setopt($ch, CURLOPT_URL, $url);
$jsonData = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch); // Close session

if ($httpCode !== 200) {
    die("HTTP Error: Status Code $httpCode");
}

// Decode JSON and extract the change value
$data = json_decode($jsonData, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON Error: " . json_last_error_msg());
}

if (isset($data['priceInfo']['change'])) {
    $change = round($data['priceInfo']['change'], 2);
    $color = ($change > 0) ? "lime"  : "red";
    echo "<br>Last Change : <font color='$color'>".$change."</font>";
    echo "<br>Current Price ".$lastPrice = round($data['priceInfo']['lastPrice'],2);
} else {
    echo "Change data not found!";
}
?>
