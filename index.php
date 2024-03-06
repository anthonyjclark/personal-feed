<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark" />

    <title>Personal Feed</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" />

    <style>
        /* .channel-title {
            font-size: 18pt;
            border-bottom: 1px solid black;
        }

        .channel-description {
            font-size: 12pt;
            margin-bottom: 1em;
        }

        .item-title {
            font-size: 15pt;
        }

        .item-timestamp {
            font-size: 10pt;
            margin-bottom: 1em;
        } */
    </style>

</head>

<body>
    <main class="container">

        <!--
            Libraries:
            - using: https://github.com/dg/rss-php
            - https://github.com/simplepie/simplepie
            - https://github.com/RSS-Bridge/rss-bridge
            - https://github.com/FreshRSS/FreshRSS

            TODO:
            - add more feeds
            - add feeds to array
            - sort array by date

            // "https://andrewkelley.me/rss.xml",
            // "https://jvns.ca/atom.xml",
            // "https://css-tricks.com/archives/feed/",
            // "https://xeiaso.net/blog/feed.xml",
            // "https://nullprogram.com/index.rss",
            // "https://eli.thegreenplace.net/feeds/all.atom.xml",
            // "https://blog.m-ou.se/feed.xml",
            // "https://raphlinus.github.io/feed.xml",
            // "https://jalammar.github.io/feed.xml",
            // "https://growtika.com/blog/feed.xml",
            // "https://www.righto.com/feeds/posts/default",
            // "https://www.gingerbill.org/article/feed.xml",
            // "https://fasterthanli.me/articles/feed.xml",
            // "https://briancallahan.net/blog/feed.xml",
            // "https://ciechanow.ski/feed.xml",
            // "https://www.yet-another-blog.com/feed.xml",
            // "https://engineeringmedia.com/blog-index.xml"
            // xkcd

         -->

        <h1>Personal Feed</h1>

        <?php
        include_once("Feed.php");

        $url = "https://andrewkelley.me/rss.xml";
        $rss = Feed::loadRss($url);

        $title = htmlspecialchars($rss->title);
        $description = htmlspecialchars($rss->description);

        $html = '';
        $html .= "<h1 class='channel-title'><a href='$rss->link'>$title</a></h1>\n";
        $html .= "<p class='channel-description'><i>$rss->description</i></p>\n";

        $count = 0;
        foreach ($rss->item as $item) {

            $title = htmlspecialchars($item->title);
            $link = htmlspecialchars($item->link);
            $date = date('D M j Y', (int) $item->timestamp);

            $html .= "<h2 class='item-title'><a href='$link'>$title</a></h2>\n";
            $html .= "<p class='item-timestamp'>$date</p>\n";
            // $html .= "<p class='item-description'>$item->description</p>";
            // $html .= "<p class='item-content'>$item->{'content:encoded'}</p>";
        
            // echo 'Title: ', $item->title;
            // echo 'Link: ', $item->url;
            // echo 'Timestamp: ', $item->timestamp;
            // echo 'Description ', $item->description;
            // echo 'HTML encoded content: ', $item->{'content:encoded'};
        
            // if (isset($item->{'content:encoded'})) {
            //     $html .= "<div class='item-content'>$item->{'content:encoded'}</div>";
            // } else {
            //     $html .= "<p class='item-description'>$item->description</p>";
            // }
        

            $count++;

            if ($count >= 5) {
                break;
            }
        }

        $url = "https://jvns.ca/atom.xml";
        $atom = Feed::loadAtom($url);

        $title = htmlspecialchars($atom->title);
        $description = htmlspecialchars($atom->description);

        $html .= "<h1 class='channel-title'><a href='$atom->link'>$title</a></h1>\n";
        $html .= "<p class='channel-description'><i>$atom->description</i></p>\n";

        $count = 0;
        foreach ($atom->entry as $entry) {

            $title = htmlspecialchars($entry->title);
            $link = htmlspecialchars($entry->link['href']);
            $date = date('D M j Y', (int) $entry->timestamp);

            $html .= "<h2 class='item-title'><a href='$link'>$title</a></h2>\n";
            $html .= "<p class='item-timestamp'>$date</p>\n";

            $count++;

            if ($count >= 5) {
                break;
            }
        }

        echo $html;

        ?>

        <script>







    </main >
</body >

</html >
        