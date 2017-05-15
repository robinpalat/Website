<?php
/**
 * @file
 * Rules plugin implementation.
 */

/**
 * Base conditional statement plugin implementation.
 */
abstract class RulesConditionalContainer extends RulesContainerPlugin implements RulesActionInterface {
  /**
   * Magic methods to intercept.
   * @var array
   */
  protected $interceptMethods = array();

  /**
   * @var RulesActionContainer
   */
  protected $fluentElement;

  protected $providesVariables;

  public function label() {
    $info = $this->pluginInfo();
    $label = isset($info['label']) ? $info['label'] : t('unlabeled');
    return $label;
  }

  /**
   * Intercepts calls to magic methods, possibly using reserved keywords.
   */
  public function __call($name, $arguments) {
    if (in_array($name, $this->interceptMethods) && method_exists($this, $mapMethod = 'call_' . $name)) {
      return call_user_func_array(array($this, $mapMethod), $arguments);
    }
    else {
      return parent::__call($name, $arguments);
    }
  }

  /**
   * Adds an action to the active fluent statement.
   *
   * Pass either an instance of the RulesActionInterface or the arguments as
   * needed by rules_action().
   *
   * @param $name
   * @param array $settings
   * @return $this
   *   Returns $this for fluent interface.
   */
  public function action($name, array $settings = array()) {
    if (isset($this->fluentElement)) {
      $this->fluentElement->action($name, $settings);
    }
    return $this;
  }

  /**
   * Evaluates the conditional statement.
   */
  public function evaluate(RulesState $state) {
    // Evaluate selected branches.
    $branches = $this->selectBranches($state);
    foreach ($branches as $branch) {
      $branch->evaluate($state);
    }
  }

  /**
   * Asserts no variables (since a conditional is *conditionally* evaluated).
   */
  protected function variableInfoAssertions() {
    return array();
  }

  /**
   * Declares only parent state variables for individual branches.
   *
   * By definition, divergent branches should not have each other's variables.
   */
  protected function stateVariables($element = NULL) {
    return $this->availableVariables();
  }

  /**
   * Provides intersections of variables in all branches, at least one default.
   */
  public function providesVariables() {
    if (!isset($this->providesVariables)) {
      $this->providesVariables = parent::providesVariables();

      if (!$this->isRoot()) {
        // Collect variables.
        $hasDefault = FALSE;
        $childVariables = array();
        /** @var $child RulesConditionalElement */
        $isEmpty = FALSE;
        foreach ($this->children as $child) {
          $hasDefault = $hasDefault || $child->isDefault();
          if ($childProvides = $child->providesVariables()) {
            $childVariables[] = $childProvides;
          }
          else {
            // Mark as empty if any branch does not provide variables. This is
            // to avoid having to perform intersections over empty sets.
            $isEmpty = TRUE;
            break;
          }
        }

        if ($hasDefault && !$isEmpty) {
          // Collect intersection of variable names.
          $names = NULL;
          foreach ($childVariables as $variables) {
            $newNames = array_keys($variables);
            $names = isset($names) ? array_intersect($names, $newNames) : $newNames;
          }
          // Add variables.
          if (isset($names)) {
            foreach ($names as $name) {
              // Determine if variable types are consistent.
              $type = NULL;
              foreach ($childVariables as $variables) {
                if (isset($type) && $type != $variables[$name]['type']) {
                  continue 2;
                }
                else {
                  $type = $variables[$name]['type'];
                }
              }
              // Add compatible variable.
              if (isset($type)) {
                $lastVariables = end($childVariables);
                $this->providesVariables[$name] = $lastVariables[$name];
              }
            }
          }
        }
      }
    }

    return $this->providesVariables;
  }

  /**
   * Selects the branches to evaluate for this conditional.
   *
   * @param RulesState $state
   *   Rules state to use.
   * @return RulesConditionalElement[]
   *   An array of branches to evaluate.
   */
  abstract protected function selectBranches(RulesState $state);

  public function dependencies() {
    $modules = array('rules_conditional' => 1);
    $modules += array_flip(parent::dependencies());
    return array_keys($modules);
  }

  protected function exportSettings() {
    $export = parent::exportSettings();
    // Remove provided variables as plugin is only a container.
    if (isset($export['PROVIDE'])) {
      unset($export['PROVIDE']);
    }
    return $export;
  }

  public function resetInternalCache() {
    parent::resetInternalCache();
    $this->providesVariables = NULL;
  }
}

/**
 * Base conditional element plugin implementation.
 */
abstract class RulesConditionalElement extends RulesActionContainer implements RulesActionInterface {
  /**
   * The parent conditional.
   * @var RulesConditionalContainer
   */
  protected $parent;

  public function label() {
    $info = $this->pluginInfo();
    $label = isset($info['label']) ? $info['label'] : t('unlabeled');
    return $label;
  }

  /**
   * @todo Remove once http://drupal.org/node/1671344 is resolved.
   */
  public function setParent(RulesContainerPlugin $parent) {
    if ($this->parent === $parent) {
      return;
    }
    // Check parent class against the compatible class.
    $pluginInfo = $this->pluginInfo();
    if (empty($pluginInfo['embeddable'])) {
      throw new RulesEvaluationException('This element cannot be embedded.', array(), $this, RulesLog::ERROR);
    }
    elseif (!$parent instanceof $pluginInfo['embeddable']) {
      throw new RulesEvaluationException('The given container is incompatible with this element.', array(), $this, RulesLog::ERROR);
    }

    if (isset($this->parent) && ($key = array_search($this, $this->parent->children, TRUE)) !== FALSE) {
      // Remove element from any previous parent.
      unset($this->parent->children[$key]);
      $this->parent->resetInternalCache();
    }

    // Update parent.
    $this->parent = $parent;
    $parent->children[] = $this;
    $this->parent->resetInternalCache();
  }

  public function providesVariables() {
    $provides = parent::providesVariables();
    if (!$this->isRoot()) {
      foreach ($this->children as $action) {
        $provides += $action->providesVariables();
      }
    }
    return $provides;
  }

  /**
   * Determines whether this branch is default, i.e. covers the remainder of
   * conditions outside of all non-default branches inside the conditional.
   */
  public function isDefault() {
    return FALSE;
  }

  /**
   * Determines whether this branch can be evaluated.
   *
   * Non-default plugins should override this method.
   */
  public function canEvaluate(RulesState $state) {
    return $this->isDefault();
  }

  /**
   * Gets the previous sibling element.
   *
   * @return RulesPlugin
   */
  public function getPreviousSibling() {
    if (isset($this->parent)) {
      $previous = NULL;
      foreach ($this->parent->getIterator() as $element) {
        if ($element === $this) {
          return $previous;
        }
        $previous = $element;
      }
    }
    // Otherwise, return nothing if no previous sibling is applicable.
    return NULL;
  }

  /**
   * Gets the next sibling element.
   *
   * @return RulesPlugin
   */
  public function getNextSibling() {
    if (isset($this->parent)) {
      $previous = NULL;
      foreach ($this->parent->getIterator() as $element) {
        if ($previous === $this) {
          return $element;
        }
        $previous = $element;
      }
    }
    // Otherwise, return nothing if no next sibling is applicable.
    return NULL;
  }

  public function integrityCheck() {
    parent::integrityCheck();
    $this->checkSiblings();
    return $this;
  }

  /**
   * Checks basic conditional element integrity.
   */
  protected function checkSiblings() {
    // Check a default element is the last.
    if ($this->isDefault() && $this->getNextSibling()) {
      throw new RulesIntegrityException(t('The "%plugin" cannot precede another element.', array('%plugin' => $this->plugin())), $this);
    }

    $pluginInfo = $this->pluginInfo();
    // Check dependent element.
    if (!empty($pluginInfo['conditional depends'])) {
      if (!($previous = $this->getPreviousSibling()) || !in_array($previous->plugin(), $pluginInfo['conditional depends'])) {
        $depends = $pluginInfo['conditional depends'];
        $list = t('"%plugin"', array('%plugin' => array_shift($depends)));
        foreach ($depends as $depend) {
          $list = t('!preceding, "%plugin"', array(
            '!preceding' => $list,
            '%plugin' => $depend,
          ));
        }
        throw new RulesIntegrityException(t('The "%plugin" must be preceded by one of: !list.', array('%plugin' => $this->plugin(), '!list' => $list)), $this);
      }
    }
    // Check single element in a conditional container.
    if (!$this->isRoot() && $this->parentElement() instanceof RulesConditionalContainer && !empty($pluginInfo['conditional single'])) {
      $plugin = $this->plugin();
      $previous = $this->getPreviousSibling();
      $next = $this->getNextSibling();
      do {
        if (($previous && $previous->plugin() == $plugin) || ($next && $next->plugin() == $plugin)) {
          throw new RulesIntegrityException(t('The "%plugin" cannot occur more than once within the enclosing container.', array('%plugin' => $this->plugin())), $this);
        }
      }
      while (($previous && $previous = $previous->getPreviousSibling()) || ($next && $next = $next->getNextSibling()));
    }
  }

  public function dependencies() {
    $modules = array('rules_conditional' => 1);
    $modules += array_flip(parent::dependencies());
    return array_keys($modules);
  }

  protected function importChildren($export, $key = NULL) {
    parent::importChildren($export, 'DO');
  }

  protected function exportChildren($key = NULL) {
    return parent::exportChildren('DO');
  }

  protected function exportSettings() {
    $export = parent::exportSettings();
    // Remove provided variables as plugin is only a container.
    if (isset($export['PROVIDE'])) {
      unset($export['PROVIDE']);
    }
    return $export;
  }
}

/**
 * Base conditional element that uses a predicate.
 */
abstract class RulesConditionalPredicateElement extends RulesConditionalElement {
  /**
   * @var RulesCondition
   */
  protected $predicate;

  public function __construct($predicate = NULL, $settings = array()) {
    parent::__construct();
    if (isset($predicate)) {
      $predicate = is_object($predicate) && $predicate instanceof RulesConditionInterface ? $predicate : rules_condition($predicate, $settings);
      $this->setPredicate($predicate);
    }
  }

  /**
   * Sets a condition as predicate.
   */
  protected function setPredicate($predicate) {
    $this->predicate = $predicate;
    $this->predicate->parent = $this;
    // Set up variables with the new parent.
    $this->resetInternalCache();
  }

  public function resetInternalCache() {
    parent::resetInternalCache();
    if (isset($this->predicate)) {
      $this->predicate->resetInternalCache();
    }
  }

  public function __sleep() {
    $array = parent::__sleep();
    $array['predicate'] = 'predicate';
    return $array;
  }

  public function label() {
    $text = '@plugin';
    $variables = array('@plugin' => $this->pluginLabel());
    if (isset($this->predicate)) {
      $text = '@plugin: @label';
      $variables['@label'] = $this->predicate->label();
    }
    return t($text, $variables);
  }

  public function pluginLabel() {
    return parent::label();
  }

  public function integrityCheck() {
    if (!isset($this->predicate)) {
      throw new RulesIntegrityException(t('The conditional "%plugin" does not have a valid predicate.', array('%plugin' => $this->plugin())), $this);
    }
    parent::integrityCheck();
    return $this;
  }

  /**
   * Adds predicate assertions to state.
   */
  protected function stateVariables($element = NULL) {
    if (!isset($element) || $element === $this->predicate) {
      return parent::stateVariables();
    }
    else {
      // Add assertions from the predicate.
      $variables = parent::stateVariables($element);
      if (isset($this->predicate) && $assertions = $this->predicate->call('variableInfoAssertions')) {
        $variables = RulesData::addMetadataAssertions($variables, $assertions);
      }
      return $variables;
    }
  }

  public function dependencies() {
    $modules = array_flip(parent::dependencies());
    if (isset($this->predicate)) {
      $modules += array_flip($this->predicate->dependencies());
    }
    return array_keys($modules);
  }

  /**
   * Negates the predicate.
   */
  public function negate($negate = TRUE) {
    $this->predicate->negate($negate);
    return $this;
  }

  /**
   * Returns whether the predicate is negated.
   */
  public function isNegated() {
    return $this->predicate->isNegated();
  }

  /**
   * Evaluates the predicate.
   */
  public function canEvaluate(RulesState $state) {
    return $this->predicate->evaluate($state);
  }

  /**
   * Imports predicate.
   */
  protected function importChildren($export, $key = NULL) {
    $this->importPredicate($export);
    parent::importChildren($export, 'DO');
  }

  /**
   * Imports predicate.
   */
  protected function importPredicate($export, $key = NULL) {
    if (!isset($key)) {
      $key = strtoupper($this->plugin());
    }
    $predicate = rules_plugin_factory('condition');
    $this->setPredicate($predicate);
    $predicate->import($export[$key]);
  }

  /**
   * Exports predicate with actions.
   */
  protected function exportChildren($key = NULL) {
    $export = $this->exportPredicate();
    return $export + parent::exportChildren('DO');
  }

  /**
   * Exports predicate.
   */
  protected function exportPredicate($key = NULL) {
    $export = array();
    if (!isset($key)) {
      $key = strtoupper($this->plugin());
    }
    if (isset($this->predicate)) {
      $export[$key] = $this->predicate->export();
    }
    return $export;
  }

  protected function exportFlat() {
    return TRUE;
  }
}

/**
 * Default if-else conditional statement.
 *
 * @method RulesConditional if() if($predicate, array $settings = array()) Adds an "if" statement.
 * @method RulesConditional elseIf() elseIf($predicate, array $settings = array()) Adds an "else if" statement. This is an alias for self::if().
 * @method RulesConditional else() else() Adds an "else" statement.
 * @method RulesConditional action() action($name, array $settings = array()) Adds an action to the currently active statement. Pass arguments as rules_action() would need.
 */
class RulesConditional extends RulesConditionalContainer {
  protected $itemName = 'conditional';

  /**
   * Intercepts calls to "if" and "else".
   * @var array
   */
  protected $interceptMethods = array('if', 'elseIf', 'else');

  public function __construct() {
    parent::__construct();
  }

  /**
   * Adds an "if" statement, for use with magic call.
   */
  protected function call_if($predicate, array $settings = array()) {
    $this->fluentElement = $element = rules_conditional_if($predicate, $settings);
    $element->setParent($this);
    return $this;
  }

  /**
   * Adds an "if" as an "else if" statement, for use with magic call.
   */
  protected function call_elseIf($predicate, array $settings = array()) {
    return $this->call_if($predicate, $settings);
  }

  /**
   * Adds an "else" statement, for use with magic call.
   */
  protected function call_else() {
    $this->fluentElement = $element = rules_conditional_else();
    $element->setParent($this);
    return $this;
  }

  /**
   * Selects the branches to evaluate for this conditional.
   *
   * @param RulesState $state
   *   Rules state to use.
   * @return RulesConditionalElement[]
   *   An array of branches to evaluate.
   */
  protected function selectBranches(RulesState $state) {
    /** @var $branch RulesConditionalElement */
    foreach ($this->children as $branch) {
      // Select the first matched branch.
      if ($branch->canEvaluate($state)) {
        return array($branch);
      }
    }
    // Return no branch if none matched.
    return array();
  }

  protected function exportFlat() {
    return TRUE;
  }
}

/**
 * The "if" clause.
 */
class RulesConditionalIf extends RulesConditionalPredicateElement {
  protected $itemName = 'if';

  public function pluginLabel() {
    $previous = $this->getPreviousSibling();
    if ($previous && $previous instanceof RulesConditionalIf) {
      return t('(Else) If', array(), array('context' => 'conditional rules'));
    }
    else {
      return parent::pluginLabel();
    }
  }

  /**
   * Imports predicate.
   */
  protected function importPredicate($export, $key = NULL) {
    $plugin = strtoupper($this->plugin());
    $pluginInfo = $this->pluginInfo();
    $keys = !empty($pluginInfo['import keys']) ? $pluginInfo['import keys'] : array($plugin);
    foreach ($keys as $key) {
      if (isset($export[$key])) {
        parent::importPredicate($export, $key);
        break;
      }
    }
  }

  /**
   * Exports predicate.
   */
  protected function exportPredicate($key = NULL) {
    if ($this->getPreviousSibling()) {
      $key = 'ELSE IF';
    }
    return parent::exportPredicate($key);
  }
}

/**
 * The "else" clause.
 */
class RulesConditionalElse extends RulesConditionalElement {
  protected $itemName = 'else';

  public function __construct() {
    parent::__construct();
  }

  public function isDefault() {
    return TRUE;
  }

  protected function importChildren($export, $key = NULL) {
    RulesContainerPlugin::importChildren($export);
  }

  protected function exportChildren($key = NULL) {
    return RulesContainerPlugin::exportChildren();
  }

  protected function exportFlat() {
    return TRUE;
  }
}

/**
 * Switch conditional container.
 *
 * @method RulesConditionalSwitch case() case($value, $fallThrough = FALSE, $valueIsSelector = FALSE) Adds a "case" statement.
 * @method RulesConditionalSwitch defaultCase() defaultCase() Adds a "default case" statement.
 * @method RulesConditionalSwitch action() action($name, array $settings = array()) Adds an action to the currently active statement. Pass arguments as rules_action() would need.
 */
class RulesConditionalSwitch extends RulesConditionalContainer {
  protected $itemName = 'switch';

  /**
   * Intercepts calls to "case" and "defaultCase".
   * @var array
   */
  protected $interceptMethods = array('case', 'defaultCase');

  public function __construct($dataSelector = NULL) {
    parent::__construct();
    if (isset($dataSelector)) {
      $this->settings['data:select'] = $dataSelector;
    }
  }

  /**
   * Adds a "case" statement, for use with magic call.
   */
  protected function call_case($settings = array(), $fallThrough = FALSE) {
    $this->fluentElement = $element = rules_conditional_case($settings, $fallThrough);
    $element->setParent($this);
    return $this;
  }

  /**
   * Adds a "defaultCase" statement, for use with magic call.
   */
  protected function call_defaultCase() {
    $this->fluentElement = $element = rules_conditional_default_case();
    $element->setParent($this);
    return $this;
  }

  public function pluginParameterInfo() {
    $parameterInfo = array(
      'data' => array(
        'type' => '*',
        'label' => t('Data to match cases against'),
        'description' => t('The data to be compared, specified by using a data selector, e.g. "node:author:name".'),
        'restriction' => 'selector',
        'allow null' => TRUE,
      ),
    );
    return $parameterInfo;
  }

  /**
   * Selects the branches to evaluate for this conditional.
   *
   * @param RulesState $state
   *   Rules state to use.
   * @return RulesConditionalElement[]
   *   An array of branches to evaluate.
   */
  protected function selectBranches(RulesState $state) {
    $branches = array();
    // Collect all cases to be evaluated.
    $fallThrough = FALSE;
    foreach ($this->children as $case) {
      /** @var $case RulesConditionalCase */
      if ($case->canEvaluate($state)) {
        $branches[] = $case;
      }
    }
    return $branches;
  }

  protected function importChildren($export, $key = NULL) {
    parent::importChildren($export, 'DO');
  }

  protected function exportChildren($key = NULL) {
    return parent::exportChildren('DO');
  }
}

/**
 * Switch case.
 */
class RulesConditionalCase extends RulesConditionalElement {
  protected $itemName = 'case';

  /**
   * @var RulesPlugin
   */
  protected $condition;

  /**
   * Evaluated condition results.
   * @var array
   */
  protected $conditionResultCache = array();

  public function __construct($settings = array(), $fallThrough = FALSE) {
    parent::__construct();
    if (isset($settings['value'])) {
      $this->settings['value'] = $settings['value'];
    }
    elseif (isset($settings['value:select'])) {
      $this->settings['value:select'] = $settings['value:select'];
    }
    $this->settings += array('fall_through' => $fallThrough);
  }

  public function __destruct() {
    unset($this->condition);
    unset($this->conditionResultCache);
  }

  public function forceSetUp() {
    parent::forceSetUp();
    $this->setUpCondition();
  }

  public function pluginParameterInfo() {
    $parameterInfo = array(
      'value' => array(
        'type' => '*',
        'label' => t('Data value'),
        'description' => t('The value to compare the data with.'),
        'allow null' => TRUE,
      ),
      'fall_through' => array(
        'type' => 'boolean',
        'label' => t('Fall through'),
        'description' => t('Fall through to next case when complete. If this option is checked, the next case is automatically executed (regardless of the case value) when this case is finished. If not, the switch will terminate when the case is finished.'),
        'optional' => TRUE,
        'default value' => FALSE,
        'restriction' => 'input',
      ),
    );
    // Derive parameter info from switch variable selector.
    $dataSelector = isset($this->parent->settings['data:select']) ? $this->parent->settings['data:select'] : NULL;
    if ($wrapper = $this->applyDataSelector($dataSelector)) {
      $parameterInfo['value']['type'] = $wrapper->type();
    }
    return $parameterInfo;
  }

  public function stateVariables($element = NULL) {
    $this->forceSetUp();
    if (!isset($element) || $element === $this->condition) {
      return parent::stateVariables();
    }
    else {
      // Add assertions from the condition.
      $variables = parent::stateVariables($element);
      if (isset($this->condition) && $assertions = $this->condition->call('variableInfoAssertions')) {
        $variables = RulesData::addMetadataAssertions($variables, $assertions);
      }
      return $variables;
    }
  }

  protected function setUpCondition() {
    if (!isset($this->condition) && isset($this->parent)) {
      // Prepare settings for 'data_is' condition.
      $settings = array(
        'data:select' => $this->parent->settings['data:select'],
        'op' => '==',
      );
      if (isset($this->settings['value:select'])) {
        $settings['value:select'] = $this->settings['value:select'];
      }
      elseif (isset($this->settings['value'])) {
        $settings['value'] = $this->settings['value'];
      }
      else {
        // Abort if settings are incomplete.
        return;
      }
      // Set up 'data_is'.
      $this->condition = rules_condition('data_is', $settings);
      $this->condition->parent = $this;
      $this->condition->processSettings();
    }
  }

  /**
   * Returns whether this case should fall through.
   */
  public function fallThrough() {
    return !empty($this->settings['fall_through']);
  }

  /**
   * Determines whether this branch can be evaluated.
   */
  public function canEvaluate(RulesState $state) {
    $this->forceSetUp();
    // Check if this element has fallen through.
    if ($previous = $this->getPreviousSibling()) {
      /** @var $previous self */
      if ($previous instanceof self && $previous->fallThrough() && $previous->canEvaluate($state)) {
        return TRUE;
      }
    }
    // Evaluate condition for the given state once.
    $this->conditionResultCache += array('state' => array(), 'result' => array());
    if (empty($this->conditionResultCache['state']) || !$cacheKey = array_search($state, $this->conditionResultCache['state'], TRUE)) {
      $cacheKey = count($this->conditionResultCache['state']);
      $this->conditionResultCache['state'][$cacheKey] = $state;
      $this->conditionResultCache['result'][$cacheKey] = $this->condition->evaluate($state);
    }
    return !empty($this->conditionResultCache['result'][$cacheKey]);
  }

  public function resetInternalCache() {
    parent::resetInternalCache();
    $this->condition = NULL;
    $this->conditionResultCache = array();
  }
}

/**
 * Switch default case.
 */
class RulesConditionalDefaultCase extends RulesConditionalElement {
  protected $itemName = 'default case';

  public function __construct() {
    parent::__construct();
  }

  public function isDefault() {
    return TRUE;
  }

  protected function importChildren($export, $key = NULL) {
    RulesContainerPlugin::importChildren($export);
  }

  protected function exportChildren($key = NULL) {
    return RulesContainerPlugin::exportChildren();
  }

  protected function exportFlat() {
    return TRUE;
  }
}

/**
 * While loop.
 */
class RulesConditionalWhile extends RulesConditionalPredicateElement {
  protected $itemName = 'while';

  public function providesVariables() {
    return array();
  }

  public function evaluate(RulesState $state) {
    $iteration = 0;
    $maxIterations = variable_get('rules_conditional_max_iterations', RULES_CONDITIONAL_MAX_ITERATIONS);
    while ($iteration < $maxIterations && $this->canEvaluate($state)) {
      // Use a separate state so variables are available in the loop only.
      $clonedState = clone $state;
      parent::evaluate($clonedState);
      $iteration ++;

      // Retrieve variables.
      foreach ($state->variables as $key => &$value) {
        if (array_key_exists($key, $clonedState->variables)) {
          $value = $clonedState->variables[$key];
        }
      }
    }
  }
}
