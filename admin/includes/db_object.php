<?php

    class Db_object {

        protected static $db_table = "users";

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

                $this->user_image = basename($file['name']);
                $this->type = $file['type'];
                $this->size = $file['size'];
                $this->tmp_path = $file['tmp_name'];
            }

        }

        public static function findAll() {

            return static::findByQuery("SELECT * FROM " . static::$db_table . " ");
        }

        public static function findById($id) {

            // global $database;

            $the_result_array = static::findByQuery("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");

            return !empty($the_result_array) ? array_shift($the_result_array) : false;

        }

        public static function findByQuery($sql) {

            global $database;

            $resultSet = $database->query($sql);
            $the_object_array = array();

            while ($row = $resultSet->fetch_assoc()) {

                $the_object_array[] = static::instantiation($row);
            }

            return $the_object_array;
        }

        public static function instantiation($the_record) {

            $calling_class = get_called_class();

            $the_object = new $calling_class;

            foreach ($the_record as $property => $value) {

                if ($the_object->hasProperty($property)) {

                    $the_object->$property = $value;
                }
            }

            return $the_object;
        }

        private function hasProperty($property) {

            $object_properties = get_object_vars($this);
            return array_key_exists($property, $object_properties);

            // return property_exists($this, $property);
            // if (property_exists('User', $property)) {
            //     return true;
            // } else {
            //     return false;
            // }

        }

        protected function properties() {

            $properties = array();

            foreach (static::$db_table_fields as $table_field) {

                if (property_exists($this, $table_field)) {

                    if (!empty($this->$table_field)) {

                        $properties[$table_field] = $this->$table_field;
                    }

                }

            }

            return $properties;
        }

        protected function cleanProperties() {

            global $database;

            $clean_properties = array();

            foreach ($this->properties() as $key => $value) {

                $clean_properties[$key] = $database->escapeString($value);
            }

            return $clean_properties;

        }

        public function save() {

            return isset($this->id) ? $this->update() : $this->create();
        }

        public function create() {

            global $database;

            $properties = $this->cleanProperties();

            $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")";
            $sql .= " VALUES ('" . implode("','", array_values($properties)) . "')";

            if ($database->query($sql)) {

                $this->id = $database->insertId();

                return true;
            } else {

                return false;
            }

        }

        public function update() {

            global $database;

            $properties = $this->cleanProperties();

            $properties_pairs = array();

            foreach ($properties as $key => $value) {

                $properties_pairs[] = "{$key} = '{$value}'";
            }

            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= implode(", ", $properties_pairs);
            $sql .= " WHERE id = " . $database->escapeString($this->id);

            $database->query($sql);

            return ($database->connection->affected_rows == 1) ? true : false;

        }

        public function delete() {

            global $database;

            $sql = "DELETE FROM " . static::$db_table . " ";
            $sql .= "WHERE id = " . $database->escapeString($this->id);
            $sql .= " LIMIT 1";

            $database->query($sql);

            return ($database->connection->affected_rows == 1) ? true : false;

        }

        public static function countAll() {

            $count = count(self::findAll());
            return $count;

            // global $database;
            //
            // $sql = "SELECT COUNT(*) FROM " . static::$db_table;
            // $resultSet = $database->query($sql);
            // $row = mysqli_fetch_array($resultSet);
            //
            // return array_shift($row);

        }

    }

?>
