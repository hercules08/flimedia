<?php
return [
  "post_type" => "inventory",
  "tax_query" => [
      [
          'taxonomy' => 'inventory_vehicle_types',
          'field' => 'slug',
          'terms' => 'pre-owned-vehicles',
      ],
  ],
  "post_status" => "publish",
  "orderby" => "publish_date",
  "order" => "ASC",
  "posts_per_page" => -1
];