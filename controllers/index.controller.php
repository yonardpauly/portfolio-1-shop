<?php

$Index = new class extends IndexModel
{
   function get_show_items () {

      return $this->set_show_items();
   }

   function get_show_item_categories () {

      return $this->set_show_item_categories();
   }


};