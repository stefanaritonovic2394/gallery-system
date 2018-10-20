<?php

    class Photo extends Db_object {

        protected static $db_table = "photos";
        protected static $db_table_fields = array('title', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size', 'created');
        public $id;
        public $title;
        public $caption;
        public $description;
        public $filename;
        public $alternate_text;
        public $type;
        public $size;
        public $created;

        public $tmp_path;
        public $upload_directory = "images";
        public $errors = array();
        public $upload_errors_array = array(

            UPLOAD_ERR_OK           => "Ne postoji greška",
            UPLOAD_ERR_INI_SIZE     => "Upload-ovana datoteka prelazi vrednost upload_max_filesize direktive u php.ini",
            UPLOAD_ERR_FORM_SIZE    => "Upload-ovana datoteka prelazi vrednost MAX_FILE_SIZE direktive koja je navedena u HTML formi.",
            UPLOAD_ERR_PARTIAL      => "Upload-ovana datoteka je samo delimično uploadovana.",
            UPLOAD_ERR_NO_FILE      => "Nijedna datoteka nije uploadovana.",
            UPLOAD_ERR_NO_TMP_DIR   => "Nedostaje privremeni direktorijum.",
            UPLOAD_ERR_CANT_WRITE   => "Nije uspelo pisanje datoteke na disk.",
            UPLOAD_ERR_EXTENSION    => "PHP ekstenzija je zaustavila upload datoteke."

        );

        public function setFile($file) {

            if (empty($file) || !$file || !is_array($file)) {

                $this->errors[] = "Nijedan fajl nije upload-ovan ovde";
                return false;
            } elseif ($file['error'] != 0) {

                $this->errors[] = $this->upload_errors_array[$file['error']];
                return false;
            } else {

                $this->filename = basename($file['name']);
                $this->type = $file['type'];
                $this->size = $file['size'];
                $this->tmp_path = $file['tmp_name'];
            }

        }

        public function picturePath() {

            return $this->upload_directory . DS . $this->filename;
        }

        public function save() {

            if ($this->id) {

                $this->update();
            } else {

                if (!empty($this->errors)) {

                    return false;
                }

                if (empty($this->filename) || empty($this->tmp_path)) {

                    $this->errors[] = "Fajl nije dostupan";
                    return false;
                }

                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

                if (file_exists($target_path)) {
                    $this->errors[] = "Fajl sa nazivom {$this->filename} već postoji";
                    return false;
                }

                if (move_uploaded_file($this->tmp_path, $target_path)) {

                    if ($this->create()) {

                        unset($this->tmp_path);
                        return true;
                    }

                } else {

                    $this->errors[] = "Folder verovatno nema dozvole";
                    return false;
                }

            }

        }

        public function deletePhoto() {

            if ($this->delete()) {

                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picturePath();
                return unlink($target_path) ? true : false;
            } else {

                return false;
            }

        }

        public function comments() {

            return Comment::findComments($this->id);
        }

        public static function displaySidebarData($photo_id) {

            $photo = Photo::findById($photo_id);

            $output = "<a href='#'><img class='img-thumbnail' width='100' src='{$photo->picturePath()}'></a>";
            $output .= "<p>{$photo->filename}</p>";
            $output .= "<p>{$photo->type}</p>";
            $output .= "<p>{$photo->size}</p>";

            echo $output;

        }

    }

?>
