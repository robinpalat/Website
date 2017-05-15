<?php

/**
 * @file
 * Helper for https://www.drupal.org/node/2488180
 * Credit: joelpittet, stefan.r
 */

/**
 * Allows for converting all databases to another charset.
 */
class DrupalCharsetConverter {

  /**
   * Character set.
   * @var string
   */
  protected $charset = 'utf8mb4';

  /**
   * Collation.
   * @var string
   */
  protected $collation = 'utf8mb4_general_ci';

  public function __construct($charset = NULL, $collation = NULL) {
    if ($charset) {
      $this->charset = $charset;
    }
    if ($collation) {
      $this->collation = $collation;
    }
  }

  /**
   * Convert the MySQL drupal databases character set and collation.
   *
   * @param array $databases
   *   The Drupal 7 database info array.
   */
  public function convert(array $databases) {
    $success = FALSE;
    foreach ($databases as $database_key => $database_values) {
      foreach ($database_values as $target => $database) {
        // mysql, mysqli, etc.
        if (strpos($database['driver'], 'mysql') === 0) {
          drush_print('Target MySQL database: ' . $database['database'] . '@' . $database['host'] . ' (' . $database_key . ':' . $target  . ')' );
          // Connect to next database.
          db_set_active($database_key);
          $connection = Database::getConnection();
          // Check the database type is mysql.
          $db_type = $connection->databaseType();
          // Skip if not MySQL.
          if ($db_type !== 'mysql') {
            continue;
          }
          if ($this->charset == 'utf8mb4' && !$connection->utf8mb4IsSupported()) {
            drush_print('The ' . $database_key . ':' . $target . ' MySQL database does not support UTF8MB4! Ensure that the conditions listed in settings.php related to innodb_large_prefix, the server version, and the MySQL driver version are met. See https://www.drupal.org/node/2754539 for more information.');
            continue;
          }
          // For each database:
          $this->convertDatabase($database['database']);
          // For each table in the database.
          $this->convertTables();
          $success = TRUE;
          drush_print('Finished converting the ' . $database_key . ':' . $target . ' MySQL database!');
        }
      }
    }
    // Reset connection to default.
    db_set_active();
    return $success;
  }

  /**
   * @param string
   *   Database name.
   * @param string $charset
   *   (Optional) The character set.
   * @param string $collation
   *   (Optional) The collation.
   *
   * @return bool
   *   success|failure.
   */
  public function convertDatabase($database_name, $charset = NULL, $collation = NULL) {
    drush_print('Converting database: ' . $database_name);
    $sql = "ALTER DATABASE `" . $database_name . "` CHARACTER SET = :charset COLLATE = :collation;";
    return db_query($sql, array(
      ':charset' => $charset ?: $this->charset,
      ':collation' => $collation ?: $this->collation,
    ));
  }

  /**
   * Converts all the tables defined by drupal_get_schema().
   *
   * @param string $charset
   *   (Optional) The character set.
   * @param string $collation
   *   (Optional) The collation.
   *
   * @return bool
   *   success|failure.
   */
  public function convertTables($charset = NULL, $collation = NULL) {
    // For each table:
    // Deal only with Drupal managed tables.
    $schema = drupal_get_schema();
    $table_names = array_keys($schema);
    sort($table_names);
    foreach ($table_names as $table_name) {
      if (!db_table_exists($table_name)) {
        continue;
      }
      $this->convertTable($table_name, $charset, $collation);
    }
  }

  /**
   * Converts a table to a desired character set and collation.
   *
   * @param string $table_name
   *  The database table name.
   * @param string $charset
   *   (Optional) The character set.
   * @param string $collation
   *   (Optional) The collation.
   *
   * @return bool
   *   success|failure.
   */
  public function convertTable($table_name, $charset = NULL, $collation = NULL) {
    db_query("ALTER TABLE {" . $table_name . "} ROW_FORMAT=DYNAMIC ENGINE=INNODB");
    $sql = "ALTER TABLE {" . $table_name . "} CHARACTER SET = :charset COLLATE = :collation";
    drush_print('Converting table: ' . $table_name);
    $result = db_query($sql, array(
      ':charset' => $charset ?: $this->charset,
      ':collation' => $collation ?: $this->collation,
    ));
    $this->convertTableFields($table_name, $charset, $collation);
    db_query("OPTIMIZE TABLE {" . $table_name . "}");
    return $result;
  }

  /**
   * Converts a table's field to a desired character set and collation.
   *
   * @param string $table_name
   *  The database table name.
   * @param string $charset
   *   (Optional) The character set.
   * @param string $collation
   *   (Optional) The collation.
   *
   * @return bool
   *   success|failure.
   */
  public function convertTableFields($table_name, $charset = NULL, $collation = NULL) {
    $results = db_query("SHOW FULL FIELDS FROM {" . $table_name . "}")->fetchAllAssoc('Field');
    $charset = $charset ?: $this->charset;
    $collation = $collation ?: $this->collation;
    foreach ($results as $row) {
      // Skip fields that don't have collation, as they are probably int or similar.
      // or if we are using that collation for this field already save a query
      // or is not binary.
      if (!$row->Collation || $row->Collation === $collation || strpos($row->Collation, '_bin') !== FALSE) {
        continue;
      }
      $default = '';
      if ($row->Default !== NULL) {
        $default = 'DEFAULT ' . ($row->Default == "CURRENT_TIMESTAMP" ? "CURRENT_TIMESTAMP" : ":default");
      }
      elseif ($row->Null == 'YES' && $row->Key == '') {
        if ($row->Type == 'timestamp') {
          $default = 'NULL ';
        }
        $default .= 'DEFAULT NULL';
      }

      $sql = "ALTER TABLE {" . $table_name . "}
              MODIFY " . $row->Field . " " .
              $row->Type . " " .
              "CHARACTER SET :charset COLLATE :collation " .
              ($row->Null == "YES" ? "" : "NOT NULL ") .
              $default . " " .
              $row->Extra . " " .
              "COMMENT :comment";

      $params = array(
        ':charset' => $charset,
        ':collation' => $collation,
        ':comment' => $row->Comment,
      );
      if (strstr($default, ':default')) {
        $params[':default'] = $row->Default;
      }
      db_query($sql, $params);
    }
  }
}

function utf8mb4_convert_drush_command() {
  $items = array();

  $items['utf8mb4-convert-databases'] = array(
    'description' => "Converts all databases defined in settings.php to utf8mb4.",
    'bootstrap' => DRUSH_BOOTSTRAP_DRUPAL_FULL,
    'options' => array(
      'collation' => 'Specify a collation. Default is utf8mb4_general_ci.',
      'charset' => 'Specify a charset. Default is utf8mb4.',
    )
  );

  return $items;
}

function drush_utf8mb4_convert_databases() {
  $charset = drush_get_option('charset', 'utf8mb4');
  $collation = drush_get_option('collation', 'utf8mb4_general_ci');
  global $databases;
  if (version_compare(VERSION, '7.50', '<')) {
    drush_print('Please install Drupal 7.50 or above prior to running this script.');
    return;
  }
  if (!drush_confirm('This will convert all databases defined in settings.php to utf8mb4. Back up your databases before continuing! Continue?')) {
    return;
  }
  $converter = new DrupalCharsetConverter($charset, $collation);
  $success = $converter->convert($databases);
  // Prevent the hook_requirements() check from telling us to convert the
  // database to utf8mb4.
  if ($success) {
    variable_set('drupal_all_databases_are_utf8mb4', TRUE);
  }
}
