# 🕸️ AR's Web Crawler

AR's Web Crawler is a PHP-based web crawling application that allows users to search for a specific keyword on a webpage and explore external URLs up to a specified depth.


## Features 🚀

### 1. Search Form 📝

- Users can enter a search keyword and set the depth of the crawl in the provided form.
- The default depth is set to 0.

### 2. Crawling 🕷️

- The application sends HTTP requests to the URLs in the queue, retrieves HTML content, and saves it.
- The crawler respects the depth limit set by the user.

### 3. HTML Parsing 🌐

- Utilizes the DOMDocument class in PHP for HTML parsing.
- Extracts relevant information from crawled pages, such as titles and meta descriptions.

### 4. URL Extraction 🔗

- Extracts all hyperlinks (URLs) from the crawled HTML and adds them to the URL queue.

### 5. External URLs 🌍

- Displays a list of external URLs found on the search page.
- Users can click the "Search" button next to each URL to perform a new search with that URL as the root.

### 6. Search Module 🔍

- Implements a search module that searches for a specified string within the crawled content.
- Displays or logs URLs that contain the search string along with the matched content.

### 7. Robots.txt Compliance 🤖

- Checks for and respects the rules specified in the robots.txt file of the website being crawled.

### 8. Error Handling ⚠️

- Implements error handling to manage situations where a page cannot be fetched, parsed, or other issues during crawling.

## Usage 🛠️

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/ars-web-crawler.git

2. Open index.php in a web browser to access the web crawler interface.

3. Enter a search keyword and set the depth in the form.

4. Click the "Submit" button to initiate the web crawling process.

5. Explore the list of external URLs and click the "Search" button to perform additional searches.


### Dependencies 📦
 - PHP 7.x
 - cURL extension for PHP


## License 📄
This Project was made by Syed Abdulrab - CMS 369946 - Student of the Software Engineering Programme at NUST - SEECS