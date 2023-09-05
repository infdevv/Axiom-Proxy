<?php
function fetch_url($url) {
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // You may want to enable this for security
    
    $response = curl_exec($ch);
    
    if ($response === false) {
        // Handle cURL error
        $error_message = curl_error($ch);
        die("cURL error: $error_message");
    }
    
    curl_close($ch);
    
    return $response;
}

// Get the URL to proxy from the query parameter "url"
if (isset($_GET['url'])) {
    $target_url = $_GET['url'];
    
    // Fetch the content from the target URL
    $content = fetch_url($target_url);
    
    // Forward the content to the client
    echo $content;
} else {
    // If the "url" parameter is not provided, display an error message
    echo "Please provide a 'url' parameter to use this proxy.";
}
