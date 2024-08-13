<?php

if (isset($_POST)) {
    $data = file_get_contents("php://input");
    $user = json_decode($data, true);
    echo $user["url"]
}

// include_once("Feed.php");

// $post_body = trim(file_get_contents("php://input"));
// $post_json = json_decode($post_body, true);

// $url = $post_json['url'];
// $type = $post_json['type'];

// $feed_items = array();
// $error_items = array();

// $feed_html = '';
// $error_html = '';

// // Return feed_html feed and error list
// $json_data = array(
//     'feed_html' => $feed_html,
//     'error_html' => $error_html
// );

// // echo json_encode(array('hi' => 'hello'));

// // echo json_encode(['results' => 'from - GetFeed.php', 'again' => 'second']);

// // header('Content-type: application/json');
// // echo json_encode($json_data);

// $items = [
// ['tagId' => 'Ask_for_payment 1', /* your other props */],
// ['tagId' => 'Ask_for_payment 2', /* your other props */],
// ];

// $json = json_encode($items, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
// echo $json; // Will print: [{"tagId":"Ask_for_payment 1"},{"tagId":"Ask_for_payment 2"}]

?>

<!--
// try {

//     $rss = Feed::loadRss($url);

//     $blog = htmlspecialchars($rss->title);

//     $count = 0;

//     foreach ($rss->item as $item) {

//         $title = htmlspecialchars($item->title);
//         $link = htmlspecialchars($item->link);
//         $date = date('D M j Y', (int) $item->timestamp);

//         array_push($feed_items, array(
//             'blog' => $blog,
//             'title' => $title,
//             'link' => $link,
//             'date' => $date
//         ));

//         $count++;
//         if ($count >= $ARTICLES_PER_FEED) {
//             break;
//         }

//     }

// } catch (FeedException $e) {

//     array_push($error_items, $url);

// }

// usort($feed_items, function ($a, $b) {

//     return strtotime($b['date']) - strtotime($a['date']);

// });

$feed_html = '';

// $count = 0;

// foreach ($feed_items as $item) {

//     $feed_html .= "<div class='feed-item'>\n";
//     $feed_html .= "  <h4><a href='$item[link]'>$item[title]</a></h4>\n";
//     $feed_html .= "  <p>$item[date]</p>\n";
//     $feed_html .= "  <p>$item[blog]</p>\n";
//     $feed_html .= "</div>\n";

//     $count++;
//     if ($count >= $ARTICLES_TO_DISPLAY) {
//         break;
//     }

// }

$error_html = '';

// foreach ($error_items as $item) {
//     $error_html .= "<li>Error loading feed: $item</li>\n";
// }

// Return feed_html feed and error list
$json_data = array(
    'feed_html' => $feed_html,
    'error_html' => $error_html
);

header('Content-type: application/json');
echo json_encode($json_data);

?> -->

<!--





$feed_html = "<p>$url</p>\n";

$error_html = '';

$json_data = array(
    'feed_html' => $feed_html,
    'error_html' => $error_html
);

echo json_encode( $json_data );








// try {
//     $rss = Feed::loadRss($url);

//     $blog = htmlspecialchars($rss->title);

//     $count = 0;

//     foreach ($rss->item as $item) {

//         $title = htmlspecialchars($item->title);
//         $link = htmlspecialchars($item->link);
//         $date = date('D M j Y', (int) $item->timestamp);

//         array_push($feed_items, array(
//             'blog' => $blog,
//             'title' => $title,
//             'link' => $link,
//             'date' => $date
//         ));

//         $count++;
//         if ($count >= $ARTICLES_PER_FEED) {
//             break;
//         }

//     }

// } catch (FeedException $e) {

//     array_push($error_items, $url);
//     // continue;
//     // return;

// }


// // }


// // foreach ($atom_urls as $url) {

// //     try {
// //         $atom = Feed::loadAtom($url);
// //     } catch (FeedException $e) {
// //         array_push($error_items, $url);
// //         continue;
// //     }

// //     $blog = htmlspecialchars($atom->title);

// //     $count = 0;

// //     foreach ($atom->entry as $entry) {

// //         $title = htmlspecialchars($entry->title);
// //         $link = htmlspecialchars($entry->link['href']);
// //         $date = date('D M j Y', (int) $entry->timestamp);

// //         array_push($feed_items, array(
// //             'blog' => $blog,
// //             'title' => $title,
// //             'link' => $link,
// //             'date' => $date
// //         ));

// //         $count++;
// //         if ($count >= $ARTICLES_PER_FEED) {
// //             break;
// //         }

// //     }
// // }

// usort($feed_items, function ($a, $b) {
//     return strtotime($b['date']) - strtotime($a['date']);
// });

// $feed_html = '';

// $count = 0;

// foreach ($feed_items as $item) {

//     $feed_html .= "<div class='feed-item'>\n";
//     $feed_html .= "  <h4><a href='$item[link]'>$item[title]</a></h4>\n";
//     $feed_html .= "  <p>$item[date]</p>\n";
//     $feed_html .= "  <p>$item[blog]</p>\n";
//     $feed_html .= "</div>\n";

//     $count++;
//     if ($count >= $ARTICLES_TO_DISPLAY) {
//         break;
//     }

// }

// $error_html = '';

// foreach ($error_items as $item) {
//     $error_html .= "<li>Error loading feed: $item</li>\n";
// }

// // Return feed_html feed and error list
// $return_json = array(
//     'feed_html' => $feed_html,
//     'error_html' => $error_html
// );

// echo json_encode($return_json);

// ?> -->
