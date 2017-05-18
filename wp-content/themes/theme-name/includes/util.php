<?php /* ==========================================================================
  UTIL
 ========================================================================== */

// get field data
function lm_get($field_name, $id = null) {

  // get $post;
  global $post;

  // get id
  $id = ($id) ? $id : $id = $post->ID;

  // get field
  $field = get_post_meta($id, $field_name, true);

  // check if field contains array then remove empty keys
  if( is_array($field) ) {
      $field = lm_array_filter_recursive($field);
  }

  // return field
  return $field;

}

// get img
function lm_get_img($field_name, $size = null, $id = null) {

  // get $post;
  global $post;

  // get id
  $id = ($id) ? $id : $id = $post->ID;

  // get field data
  $id = lm_get($field_name, $id);

  // get size
  $size = ($size) ? $size : $size = 'thumbnail';

  // http://codex.wordpress.org/Function_Reference/wp_get_attachment_image
  $img = wp_get_attachment_image($id, $size);

  return $img;
}

//  get img src
function lm_get_img_src($field_name, $size = null, $id = null) {

  // get $post;
  global $post;

  // get id
  $id = ($id) ? $id : $id = $post->ID;

  // get field data
  $id = lm_get($field_name, $id);

  // get size
  $size = ($size) ? $size : $size = 'thumbnail';

  // http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
  $img = wp_get_attachment_image_src($id, $size);

  return $img[0];
}

// meta
function lm_meta($id = null){
  // get $post;
  global $post;

  // get id
  $id = ($id) ? $id : $id = $post->ID;
  // get rid of first two edit meta fields
  $meta = get_post_meta($id);
  foreach($meta as $key => $value) {
      $meta[$key] = lm_get($key);
  }

  return $meta;
}

// get date format
function lm_get_date_format($field_name, $format='MMM DD, YYYY', $id = null){
  $date = lm_get($field_name, $id);
  // http://php.net/manual/en/datetime.format.php
  return date_format($date, $format);
}

// img
function lm_img($id, $size = 'thumbnail') {
  // http://codex.wordpress.org/Function_Reference/wp_get_attachment_image
  return wp_get_attachment_image($id, $size);
}

// img src
function lm_img_src($id, $size = 'thumbnail') {
  // http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
  $img = wp_get_attachment_image_src($id, $size);
  return $img[0];
}

// img metadata
function lm_img_meta( $attachment_id ) {

  $attachment = get_post( $attachment_id );
  return array(
      'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
      'caption' => $attachment->post_excerpt,
      'description' => $attachment->post_content,
      'href' => get_permalink( $attachment->ID ),
      'src' => $attachment->guid,
      'title' => $attachment->post_title
  );
}


// pre meta
function lm_pre_meta($id = null) {
  // get $post;
  global $post;

  // get id
  $id = ($id) ? $id : $id = $post->ID;
  $meta = get_post_meta($id);
  foreach($meta as $key => $value) {
      lm_pre_get($key);
  }
}

// pre get meta
function lm_pre_get($field_name, $id = null) {
  echo '<h2>' . $field_name . '</h2>';
  echo '<pre>';
  print_r(get($field_name, $id));
  echo '</pre>';
  echo '<hr />';
}

// check if array is empty
function lm_is_array_empty($a){
  foreach($a as $elm)
  if(!empty($elm)) return false;
  return true;
}

// enchanced version of array_filter
function lm_array_filter_recursive($input)
{
foreach ($input as &$value)
{
if (is_array($value))
{
  $value = lm_array_filter_recursive($value);
}
}

return array_filter($input);
}

// Truncate Post Function
function lm_truncate_post($content, $amount, $wpAutoBoolean, $tagsAllowed='') {
  if(strlen($content) > $amount) {
      $truncate = $content;
      $truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
      $truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);
      $truncate = strip_tags($truncate, $tagsAllowed);
      $truncate = lm_html_cut($truncate, $amount);
      // $truncate = substr($truncate, 0, strrpos(substr($truncate, 0, $amount), ' '));
      if($wpAutoBoolean) {
          echo wpautop($truncate.'...');
      } else {
          echo $truncate.'...';
      }
  } else {
      echo $content;
  }
}

// Truncate Post Function
function lm_get_truncate_post($content, $amount, $wpAutoBoolean, $tagsAllowed='') {
  if(strlen($content) > $amount) {
      $truncate = $content;
      $truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
      $truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);
      $truncate = strip_tags($truncate, $tagsAllowed);
      $truncate = lm_html_cut($truncate, $amount);
      // $truncate = substr($truncate, 0, strrpos(substr($truncate, 0, $amount), ' '));
      if($wpAutoBoolean) {
          return wpautop($truncate.'...');
      } else {
          return $truncate.'...';
      }
  } else {
      return $content;
  }
}

// Ensures all html tags are closed properly in truncated text
function lm_html_cut($text, $max_length)
{
  $tags   = array();
  $result = "";

  $is_open   = false;
  $grab_open = false;
  $is_close  = false;
  $in_double_quotes = false;
  $in_single_quotes = false;
  $tag = "";

  $i = 0;
  $stripped = 0;

  $stripped_text = strip_tags($text);

  while ($i < strlen($text) && $stripped < strlen($stripped_text) && $stripped < $max_length)
  {
      $symbol  = $text{$i};
      $result .= $symbol;

      switch ($symbol)
      {
         case '<':
              $is_open   = true;
              $grab_open = true;
              break;

         case '"':
             if ($in_double_quotes)
                 $in_double_quotes = false;
             else
                 $in_double_quotes = true;

          break;

          case "'":
            if ($in_single_quotes)
                $in_single_quotes = false;
            else
                $in_single_quotes = true;

          break;

          case '/':
              if ($is_open && !$in_double_quotes && !$in_single_quotes)
              {
                  $is_close  = true;
                  $is_open   = false;
                  $grab_open = false;
              }

              break;

          case ' ':
              if ($is_open)
                  $grab_open = false;
              else
                  $stripped++;

              break;

          case '>':
              if ($is_open)
              {
                  $is_open   = false;
                  $grab_open = false;
                  array_push($tags, $tag);
                  $tag = "";
              }
              else if ($is_close)
              {
                  $is_close = false;
                  array_pop($tags);
                  $tag = "";
              }

              break;

          default:
              if ($grab_open || $is_close)
                  $tag .= $symbol;

              if (!$is_open && !$is_close)
                  $stripped++;
      }

      $i++;
  }

  while ($tags)
      $result .= "</".array_pop($tags).">";

  return $result;
}

// add http to string
function lm_addhttp($url) {
  if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
      $url = "http://" . $url;
  }
  return $url;
}

// returns attachement id
function lm_get_attachment_id_by_url($attachment_url = '') {

  global $wpdb;
  $attachment_id = false;

  // If there is no url, return.
  if ( '' == $attachment_url )
      return;

  // Get the upload directory paths
  $upload_dir_paths = wp_upload_dir();

  // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
  if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

      // If this is the URL of an auto-generated thumbnail, get the URL of the original image
      $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

      // Remove the upload path base directory from the attachment URL
      $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

      // Finally, run a custom database query to get the attachment ID from the modified attachment URL
      $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

  }

  // get the alt text
  //$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

  // return alt
  return $attachment_id;

}

// quick date formatter
function lm_date_formatter($date, $format = 'g:ia M jS') {
  return date($format, strtotime($date));
}

// format the tweet text to have links (Twitter)
function lm_tweet_text_formatter($text) {
  $text = htmlentities($text, ENT_QUOTES, 'utf-8');
  $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a target="_blank" href="$1">$1</a>', $text);
  $text = preg_replace('/@(\w+)/', '<a target="_blank" href="https://twitter.com/$1">@$1</a>', $text);
  $text = preg_replace('/\s#(\w+)/', ' <a target="_blank" href="https://twitter.com/search?q=%23$1&src=hash">#$1</a>', $text);
  return $text;
}

// useful caching query for wordpress my favorite
function lm_transient_query($name, $args, $loop = null, $duration = HOUR_IN_SECONDS) {
  global $post;
  $_query = get_transient($name);
  if (empty($_query)) {
      $_query = new WP_Query($args);
      // The Loop
      set_transient($name, $_query, $duration);
  }
  if ($_query->have_posts() && isset($loop)) {
      $index = 0;
      while ($_query->have_posts()) {
              $_query->the_post();
                  $loop($post, $index);
              $index++;
      }
  }
  // reset query
  wp_reset_postdata();
}

// get current paged item
function lm_get_paged(){
  global $paged;
  if( get_query_var( 'paged' ) )
      $my_page = get_query_var( 'paged' );
  else {
      if( get_query_var( 'page' ) )
          $my_page = get_query_var( 'page' );
      else
          $my_page = 1;
      set_query_var( 'paged', $my_page );
      $paged = $my_page;
  }
  return $my_page;
}

// javascript version of encode uri compontent ported to php
function lm_encode_uri_component($str) {
  $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
  return strtr(rawurlencode($str), $revert);
}

// evaluate string and add links from urls (Facebook)
function lm_linkify($string) {
  // make sure there is an http:// on all URLs
  $string = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i", "$1http://$2",$string);

  // make all URLs links
  $string = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<a target=\"_blank\" href=\"$1\">$1</A>",$string);

  // make all emails hot links
  $string = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<A HREF=\"mailto:$1\">$1</A>",$string);

  return $string;
}

// wrap the first word of a string
function lm_wrap_first_word($string, $class = "first-word") {
  return preg_replace('/(?<=\>)\b\w*\b|^\w*\b/', '<span class="'.$class.'" >$0</span>', $string);
}; ?>