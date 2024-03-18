<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/pool/libs/controllers/Controller.php';

class FeedController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function topics($uid)
    {
        // Assuming you have a valid database connection $conn


        // SQL query to select selected_topics from user table where id = $uid
        $sql = "SELECT selected_topics FROM users WHERE id = $uid";
        $result = $this->run_query($sql);

        // Check if the query was successful and if it returned a row
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $topics = explode(",", $row['selected_topics']);

            foreach ($topics as $topic) {
                // First letter capital
                //$tp = ucfirst($topic);

                echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?t=' . $topic . '">
                            <span data-feather="home" class="align-text-bottom">' . ucfirst($topic) . '</span>
                        </a>
                    </li>';
            }
        } else {
            // Handle the case where no topics are found or query fails
            echo '<li>No topics found.</li>';
        }
    }


    // ... Other existing methods ...

    /*
    public function parseRssFeed($url)
    {
        $rss = simplexml_load_file($url);
        
        // Check if the RSS feed was loaded successfully
        if ($rss === false) {
            throw new Exception("Unable to load RSS feed.");
        }

        $feedData = [
            'title' => (string) $rss->channel->title,
            'items' => []
        ];

        foreach ($rss->channel->item as $item) {
            $feedData['items'][] = [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'description' => (string) $item->description,
                'pubDate' => (string) $item->pubDate,
                // Additional elements can be added here if needed
            ];
        }

        return $feedData;
    }

    public function getFeeds($rssFeedUrl) {

        $rssFeedData = $this->parseRssFeed($rssFeedUrl);
        
        foreach ($rssFeedData['items'] as $item) {
            
            $title = $item['title'];
            //l3ft trim title
            $title = ltrim($title);
            //remove line breaks and a space at of the part where line break were removed
            
            $title = str_replace(array("\r\n", "\r", "\n"), '', $title);

            //remove the space at the beginning of the title done by ltrim , using stronger method
            $title = preg_replace('/\s+/', ' ', $title);

            $description = $item['description'];

            

            $pubDate = $item['pubDate'];
           
            echo 
            "<div class='feedpost'>
            <p><b>" .$title ."</b></p>
            
            <div class='feed-item'>
            <p>" . $description . "</p>
            <a href='/ads?l=" . $item['link'] ."' target='_blank'>Read Full Article...</a>
            </p>

            </div>
            <small>Published on: " .  $pubDate . "</small>
            </div>";
            
            //echo  $title ;
            
        }
    }
    */
    public function parseRssFeed($url)
    {
        $rss = simplexml_load_file($url);

        // Check if the RSS feed was loaded successfully
        if ($rss === false) {
            throw new Exception("Unable to load RSS feed.");
        }

        $feedData = [
            'title' => (string) $rss->channel->title,
            'items' => []
        ];

        foreach ($rss->channel->item as $item) {
            $feedData['items'][] = [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'description' => (string) $item->description,
                'pubDate' => (string) $item->pubDate,
                // Additional elements can be added here if needed
            ];
        }

        return $feedData;
    }

    public function getFeeds($rssFeedUrl) {
        $rssFeedData = $this->parseRssFeed($rssFeedUrl);
        
        foreach ($rssFeedData['items'] as $item) {
            $title = $item['title'];
            // Left trim title and replace line breaks with a space
            $title = preg_replace('/\s+/', ' ', ltrim(str_replace(["\r\n", "\r", "\n"], ' ', $title)));
    
            $description = $item['description'];
            // Remove <div> tag and its contents
            $description = preg_replace('/<div>.*?<\/div>/s', '', $description);
            // Remove "this story at Slashdot." phrase
            $description = str_replace('this story at Slashdot.', '', $description);
            // Limit description to an approximate character count for 5 lines
            $approxCharsPerLine = 50; // Adjust based on your layout
            $maxChars = $approxCharsPerLine * 5;
            $description = substr($description, 0, $maxChars);
    
            // Check for images and limit their size
            $description = preg_replace_callback(
                '/<img[^>]+>/i',
                function ($matches) {
                    // Define maximum height and width
                    $maxHeight = 480; // Example max height
                    $maxWidth = 850; // Example max width
    
                    // Replace or add the height and width attributes
                    $newTag = preg_replace('/(height="[^"]*")/i', 'height="' . $maxHeight . '"', $matches[0]);
                    $newTag = preg_replace('/(width="[^"]*")/i', 'width="' . $maxWidth . '"', $newTag);
    
                    // If no height or width attributes were present, add them
                    if (!preg_match('/height="/i', $newTag)) {
                        $newTag = preg_replace('/<img/i', '<img height="' . $maxHeight . '"', $newTag);
                    }
                    if (!preg_match('/width="/i', $newTag)) {
                        $newTag = preg_replace('/<img/i', '<img width="' . $maxWidth . '"', $newTag);
                    }
    
                    return $newTag;
                },
                $description
            );
    
            $pubDate = $item['pubDate'];
            // Remove specific time string from $pubDate
            $pubDate = str_replace(' +0000', '', $pubDate);
            
            echo "<div class='feedpost'>
                <h8><b>" . $title . "</b></h8>
                <div class='feed-item'>
                    <p>" . $description . "</p>
                    <a href='/ads?l=" . $item['link'] . "' target='_blank'>Read Full Article...</a>
                </div>
                <small>Published on: " . $pubDate . "</small>
                
            </div>";
        }
    }
    
    
    


    //write a function to convert topics to url

    public function topics_url($title)
    {
        if ($title) {

            //echo "<h4>" . $title . "</h4>";

            switch ($title) {

                case "Technology":
                    $url = "https://rss.feedspot.com/folder/5BLHuWQi6w==/rss/rsscombiner";
                    break;

                case "Podcasts":
                    $url = "https://rss.feedspot.com/folder/5BLHuWUZ5w==/rss/rsscombiner";
                    break;

                case "Physics":
                    $url = "https://rss.feedspot.com/folder/5hbMsWUi6Q==/rss/rsscombiner";
                    break;

                case "Health":
                    $url = "https://rss.feedspot.com/folder/5hbMsWUi5A==/rss/rsscombiner";
                    break;
            }

            $this->getFeeds($url);

        }
    }


    public function redirectAfterDelay($url, $delayInSeconds)
    {
        if (!headers_sent()) {
            header("Refresh: $delayInSeconds; url=$url");
        } else {
            // Convert delay from seconds to milliseconds for JavaScript
            $delayInMilliseconds = $delayInSeconds * 1000;

            echo "<script>
                    setTimeout(function() {
                        window.location.href = '$url';
                    }, $delayInMilliseconds);
                  </script>";
        }
    }





}
