<!DOCTYPE html>
<html lang="en">
<<?php
    include('functions.php');
    ?> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>AR's Web Crawler</title>
    <style>
        /* Add some custom CSS for the layout */
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container-fluid {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .left-side {
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-search {
            margin-top: 10px;
        }

        .result-list {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
            max-width: 600px;
        }

        .result-item {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .result-link {
            color: #007bff;
            text-decoration: none;
        }
    </style>
    </head>

    <body>

        <div class="container-fluid">
            <h1>AR's Web Crawler</h1>

            <div class="left-side">
                <div class="form-container">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="searchKeyword">Search Keyword:</label>
                            <input type="text" name="searchKeyword" id="searchKeyword" class="form-control" required value="Islamabad">
                        </div>
                        <div class="form-group">
                            <label for="depth">Depth:</label>
                            <input type="number" name="depth" id="depth" class="form-control" required min="0" max="4" value="0">
                        </div>
                        <button type="submit" class="btn btn-primary btn-search">Submit</button>
                    </form>

                    <?php
                    // Check if the form is submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $searchKeyword = $_POST['searchKeyword'];
                        $depth = $_POST['depth']; // Get the depth value from the form

                        $externalUrls = searchWikipedia($searchKeyword, "https://en.wikipedia.org/wiki/Pakistan", $depth);
                        echo "<h2 class='mt-3'>External URLs on the page:</h2>";
                        if (empty($externalUrls)) {
                            echo "No external URLs found.";
                        } else {
                            echo "<ul class='list-group result-list'>";
                            foreach ($externalUrls as $url) {
                                echo "<li class='list-group-item result-item'>$url<button class='btn btn-secondary btn-sm' onclick='searchWithUrl(\"$url\",\"$searchKeyword\")'>Search</button></li>";
                            }
                            echo "</ul>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>

        <script>
            // JavaScript function to open a new window with the search page for the selected URL
            function searchWithUrl(url, searchword) {
                window.open('search.php?url=' + encodeURIComponent(url) + '&searchword=' + searchword, '_blank');
            }
        </script>

    </body>

</html>