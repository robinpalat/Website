<?php

/**
 * Implements hook_rules_condition_info().
 */
function rules_cli_condition_rules_condition_info() {
  $info = array();
  $info['rules_cli_condition'] = array(
    'group' => t('System'),
    'label' => t('Command-line environment'),
  );
  return $info;
}

/**
 * Rules condition - callback
 */
function rules_cli_condition() {
  return PHP_SAPI == 'cli';
}
