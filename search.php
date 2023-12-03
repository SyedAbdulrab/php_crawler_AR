<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Search Results</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .result-list {
            list-style-type: none;
            padding: 0;
        }

        .result-item {
            margin-bottom: 10px;
            word-wrap: break-word; /* Added property to allow text to move to the next line */
        }

        .result-link {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        include 'functions.php';

        // Get the URL parameter from the query string
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $searchKeyword = isset($_GET['searchword']) ? $_GET['searchword'] : '';

        // Check if the URL parameter is empty
        if (empty($url) || empty($searchKeyword)) {
            echo "Invalid URL or search keyword.";
            exit;
        }

        // Perform a search on the provided URL
        $depth = 0; // Set your desired depth here

        // Call the searchWikipedia function with the specified URL and search keyword
        $externalUrls = searchWikipedia($searchKeyword, $url, $depth);

        ?>
        <h2 class="mb-4">Search Results for '<?php echo $searchKeyword; ?>' on '<?php echo $url; ?>'</h2>

        <?php if (empty($externalUrls)) : ?>
            <p>No results found.</p>
        <?php else : ?>
            <ul class="result-list">
                <?php foreach ($externalUrls as $resultUrl) : ?>
                    <li class="result-item">
                        <?php echo $resultUrl; ?>
                        <a href="search.php?url=<?php echo urlencode($resultUrl); ?>&searchword=<?php echo urlencode($searchKeyword); ?>" class="result-link">Search on this URL</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

</body>

</html>
