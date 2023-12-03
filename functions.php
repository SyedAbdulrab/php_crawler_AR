<?php
function searchWikipedia($searchKeyword, $root, $depth) {
    // Set cURL options
    $curl = curl_init();
    $request_type = 'GET';
    $url = $root;

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,  // Set to true to return the transfer as a string
        CURLOPT_FOLLOWLOCATION => true,  // Follow redirects
        CURLOPT_TIMEOUT => 30
    ]);

    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        echo 'Curl error: ' . curl_error($curl);
        // Handle cURL error gracefully, e.g., log the error or display a user-friendly message.
        curl_close($curl);
        return [];
    }

    curl_close($curl);

    echo "<hr>";

    // Create a DOMDocument
    $dom = new DOMDocument;

    try {
        // Load the HTML content into the DOMDocument with the LIBXML_NOWARNING option
        libxml_use_internal_errors(true);
        $dom->loadHTML($response, LIBXML_NOWARNING);
        libxml_clear_errors();
    } catch (Exception $e) {
        echo 'Error loading HTML: ' . $e->getMessage();
        // Handle HTML loading error gracefully, e.g., log the error or display a user-friendly message.
        return [];
    }

    // Create a DOMXPath based on the DOMDocument
    $xpath = new DOMXPath($dom);

    // Query and print all occurrences of the provided search keyword
    $keywordNodes = $xpath->query("//*[contains(text(), '$searchKeyword')]");
    
    echo "<h4>Occurrences of '$searchKeyword' in $url:</h4> ";
    foreach ($keywordNodes as $node) {
        echo $dom->saveHTML($node);
        echo ' ';
    }

    if (empty($keywordNodes)) {
        echo 'no occurrences found';
    }

    // Extract and store external URLs on the search page
    $externalUrls = [];
    $hrefNodes = $xpath->query('//a[@href]');
    foreach ($hrefNodes as $node) {
        $href = $node->getAttribute('href');
        // Check if the URL is external
        if (filter_var($href, FILTER_VALIDATE_URL) && strpos($href, 'wikipedia.org') === false) {
            $externalUrls[] = $href;
        }
    }

    if ($depth > 1 && !empty($externalUrls)) {
        searchWikipedia($searchKeyword, $externalUrls[0], $depth - 1);
    }

    return $externalUrls;
}
?>
