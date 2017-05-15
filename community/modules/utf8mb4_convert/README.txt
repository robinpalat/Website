REQUIREMENTS
============

1. Ensure Drupal core 7.50 or later is installed, or the patch in
   https://www.drupal.org/node/2488180 is applied if using an earlier version.
2. Ensure the requirements listed in default.settings.php under the utf8mb4
   example related to innodb_large_prefix, MySQL server version and MySQL
   driver version are met.

INSTALLATION
============

1. Run "drush @none dl utf8mb4_convert-7.x" and drush will download it into your
   .drush folder. (Alternately, you can obtain the package another way and copy
   the folder into .drush yourself.)
2. Clear the Drush cache with "drush cc drush".

USAGE
=====

1. Make backups of your databases.
2. Run "drush utf8mb4-convert-databases"
3. Enable utf8mb4 in your settings.php.
