<?php
  include("../model/api-articles.php");
  $encoded = get_five_articles();
  $articles_json = json_decode($encoded);

  header('Content-Type: text/xml; charset=utf-8', true); //set document header content type to be XML
  $xml = new DOMDocument("1.0", "UTF-8"); // Create new DOM document.

  $num = sizeof($articles_json);

  //create "RSS" element
  $rss = $xml->createElement("rss"); 
  $rss_node = $xml->appendChild($rss); //add RSS element to XML node
  $rss_node->setAttribute("version","2.0"); //set RSS version

  //create "channel" element under "RSS" element
  $channel = $xml->createElement("channel");  
  $channel_node = $rss_node->appendChild($channel);

  $channel_node->appendChild($xml->createElement("title"));
  $channel_node->appendChild($xml->createElement("link"));
  $channel_node->appendChild($xml->createElement("deskcription"));

  for ($i = 0; $i<$num; $i++)
  {
    $item_node = $channel_node->appendChild($xml->createElement("item"));
    $title_node = $item_node->appendChild($xml->createElement("title", $articles_json[$i] -> article_title)); //Add Title under "item"
    $link_node = $item_node->appendChild($xml->createElement("link", "https://mayar.abertay.ac.uk/~1702687/cmp306/view/week10.php"));
    $description_node = $item_node->appendChild($xml->createElement("description", $articles_json[$i] -> article_text));  
  }
  

  echo $xml->saveXML();
?>