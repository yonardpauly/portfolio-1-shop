<?php

class IndexModel extends Database
{
   protected function set_show_items () {

      return self::query( 'SELECT * FROM items ORDER BY created_date DESC' );
   }

   protected function set_show_item_categories () {

      return self::query( 'SELECT * FROM item_category ORDER BY created_date DESC' );
   }
}