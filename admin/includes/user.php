<?php

    class User extends Db_object {

        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        public $user_image;

        public $upload_directory = "images";
        public $image_placeholder = "http://placehold.it/400x400&text=slika";

        public function uploadPhoto() {

            if (!empty($this->errors)) {

                return false;
            }

            if (empty($this->user_image) || empty($this->tmp_path)) {

                $this->errors[] = "Fajl nije dostupan";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            if (file_exists($target_path)) {
                $this->errors[] = "Fajl sa nazivom {$this->user_image} već postoji";
                return false;
            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {

                unset($this->tmp_path);
                return true;

            } else {

                $this->errors[] = "Folder verovatno nema dozvole";
                return false;
            }

        }

        public function imagePathPlaceholder() {

            return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
        }

        public static function verifyUser($username, $password) {

            global $database;

            $username = $database->escapeString($username);
            $password = $database->escapeString($password);

            $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

            $the_result_array = self::findByQuery($sql);

            return !empty($the_result_array) ? array_shift($the_result_array) : false;
        }

        public function ajaxSaveUserImage($user_image, $user_id) {

            global $database;

            $user_image = $database->escapeString($user_image);
            $user_id = $database->escapeString($user_id);

            $this->user_image = $user_image;
            $this->id = $user_id;

            $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
            $sql .= "WHERE id = {$this->id}";
            $update_image = $database->query($sql);

            echo $this->imagePathPlaceholder();

        }

        public function deletePhoto() {

            if ($this->delete()) {

                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
                return unlink($target_path) ? true : false;
            } else {

                return false;
            }

        }

    }

    // $user = new User();

?>
