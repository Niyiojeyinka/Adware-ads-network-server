<?php


/***
 * Name:       Citedlink
 * Package:     email_helper.php
 * About:       email helper
 * Copyright:  (C) 2017,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/


function get_blog_excerpt($content,$limit)
{

$excerpt = str_split($content,$limit);
  return $excerpt[0];

}
