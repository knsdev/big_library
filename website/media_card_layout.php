<?php

function create_media_card_layout($rows, $showLinkToPublisher)
{
  $layout = "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 justify-content-center justify-content-md-start'>";

  foreach ($rows as $row) {
    $id = $row['id'];
    $title = $row['title'];
    $image = $row['image'];
    $isbn_code = $row['isbn_code'];
    $short_description = $row['short_description'];
    $type = $row['type'];
    $author_first_name = $row['author_first_name'];
    $author_last_name = $row['author_last_name'];
    $publisher_name = $row['publisher_name'];
    $publisher_address = $row['publisher_address'];
    $publish_date = $row['publish_date'];
    $status = ($row['status']) ? "Available" : "Reserved";

    $title_max_length = 30;

    if (strlen($title) > $title_max_length) {
      $title = substr($title, 0, $title_max_length - 3);
      $title .= "...";
    }

    $publisher_name_url_encoded = htmlspecialchars(urlencode($publisher_name));

    $publisher_html = ($showLinkToPublisher) ?
      "<a href='./publisher.php?publisher_name=$publisher_name_url_encoded'><p class='card-text mb-2'>$publisher_name</p></a>"
      : "<p class='card-text mb-2'>$publisher_name</p>";

    $layout .= "<div class='col' style='width: fit-content'>
                  <div class='card mb-3' style='width: 18rem'>
                    <img src='$image' class='card-img-top' alt=''>
                    <div class='card-body'>
                      <h5 class='card-title mb-2'>$title</h5>
                      <p class='card-text mb-2'>$type</p>
                      <p class='card-text mb-2'>$author_first_name $author_last_name</p>
                      $publisher_html
                      <p class='card-text mb-2'>$status</p>
                      <a href='./details.php?id=$id' class='btn btn-primary'>Details</a>
                    </div>
                  </div>
                </div>";
  }

  $layout .= "</div>";

  return $layout;
}
