<?php

    class Paginate {

        public $current_page;
        public $items_per_page;
        public $items_total_count;

        public function __construct($page=1, $items_per_page=8, $items_total_count=0) {

            $this->current_page = (int)$page;
            $this->items_per_page = (int)$items_per_page;
            $this->items_total_count = (int)$items_total_count;
        }

        public function next() {

            return $this->current_page + 1;
        }

        public function previous() {

            return $this->current_page - 1;
        }

        public function pageTotal() {

            return ceil($this->items_total_count / $this->items_per_page);
        }

        public function hasPrevious() {

            return $this->previous() >= 1 ? true : false;
        }

        public function hasNext() {

            return $this->next() <= $this->pageTotal() ? true : false;
        }

        public function offset() {

            return ($this->current_page - 1) * $this->items_per_page;
        }

    }

?>
