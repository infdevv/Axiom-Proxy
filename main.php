
text/x-generic main.php ( PHP script text )
<?php
// Get the URL parameter
$url = isset($_GET['url']) ? $_GET['url'] : '';

if ($url) {
    // Function to fetch content using a server-side proxy
    function fetchContent($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

        $content = curl_exec($ch);

        if ($content === false) {
            // Handle error if fetching content fails
            echo 'Error fetching content.';
            die();
        }

        curl_close($ch);

        return $content;
    }

    // Fetch HTML content using the server-side proxy
    $html = fetchContent($url);

    // Handle redirects
    $finalUrl = $url;
    $headers = get_headers($url, 1);

    if (isset($headers['Location'])) {
        $finalUrl = is_array($headers['Location']) ? end($headers['Location']) : $headers['Location'];
    }

    // Modify links in HTML to use the new URL
    $html = preg_replace('/(src|href)=(\'|")(?!https?:\/\/)(.*?)\2/', '$1=$2https://axiomhub.net/main.php?url=' . urlencode($finalUrl) . '$3$2', $html);

    // Set appropriate headers to avoid CORS issues
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    // Output the modified HTML
    echo $html;
} else {
    // No URL parameter provided
    echo 'Please provide a valid URL parameter.';
}
?>
