<?php

function generateLink($url, $label, $class) {
   $link = '<a href="' . $url . '" class="' . $class . '">';
   $link .= $label;
   $link .= '</a>';
   return $link;
}


function outputPostRow($number)  {
    include("travel-data.inc.php");

    $postID = "postId".$number;
    $userID = "userId".$number;
    $userNAME = "userName".$number;
    $datE = "date".$number;
    $thumb = "thumb".$number;
    $title = "title".$number;
    $excerpT = "excerpt".$number;
    $reviewsNUM = "reviewsNum".$number;
    $reviewsRATING = "reviewsRating".$number;

    $postId = $$postID;
    $userId = $$userID;
    $userName = $$userNAME;
    $href = "./images/".$$thumb;
    $alt = $$title;
    $date = $$datE;
    $excerpt = $$excerpT;
    $reviewsNum = $$reviewsNUM;
    $reviewsRating = $$reviewsRATING;

    echo "<div class=\"row\"><div class=\"col-md-4\"><a href=\"post.php?id=$postId\"><img src=\"$href\"
    alt=\"$alt\" class=\"img-responsive\"></a></div>";

    echo "<div class=\"col-md-8\"><h2>$alt</h2>
    <div class=\"details\">Posted by
    <a href=\"user.php?id=$userId\">$userName</a>";
    echo "<span class=\"pull-right\">$date</span><p class=\"ratings\">";
    for ($i=0; $i <5 ; $i++) {
      if ($reviewsRating>0) {
        echo "<img src=\"images/star-gold.svg\" width=\"16\" />";
        $reviewsRating--;
      }else {
        echo "<img src=\"images/star-white.svg\" width=\"16\" />";
      }
    }

    echo " $reviewsNum Reviews </p></div><p class=\"excerpt\">$excerpt</p>";

    echo "<p><a href=\"post.php?id=$userId\" class=\"btn btn-primary btn-sm\">
    Read more</a></p></div></div><hr/>";



}

/*
  Function constructs a string containing the <img> tags necessary to display
  star images that reflect a rating out of 5
*/
function constructRating($rating) {
    $imgTags = "";

    // first output the gold stars
    for ($i=0; $i < $rating; $i++) {
        $imgTags .= '<img src="images/star-gold.svg" width="16" />';
    }

    // then fill remainder with white stars
    for ($i=$rating; $i < 5; $i++) {
        $imgTags .= '<img src="images/star-white.svg" width="16" />';
    }

    return $imgTags;
}

?>
