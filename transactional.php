<?php

require_once 'transactional.civix.php';

/**
 * Implements hook_civicrm_alterMailParams()
 *
 * Add bounce headers for non-CiviMail messages.
 *
 * @link https://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterMailParams
 */
function transactional_civicrm_alterMailParams(&$params, $context) {
  if ($context == 'civimail') {
    return;
  }
  CRM_Mailing_Transactional::singleton()->verpify($params);
}

/**
 * Implements hook_civicrm_postEmailSend()
 *
 * Mark mail as delivered.
 *
 * @link https://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postEmailSend
 */
function transactional_civicrm_postEmailSend($params) {
  CRM_Mailing_Transactional::singleton()->delivered($params);
}

/**
 * Implements hook_civicrm_alterTemplateFile()
 *
 * Use a different template for transactional mailing reports.
 *
 * @link https://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterTemplateFile
 */
function transactional_civicrm_alterTemplateFile($formName, &$form, $context, &$tplName) {
  if ($formName == 'CRM_Mailing_Page_Report' && $context == 'page') {
    if (CRM_Mailing_Transactional::singleton()->isTransactionalMailing($form->_mailing_id)) {
      $tplName = 'CRM/Mailing/Page/Transactional.tpl';
    }
  }
}

/**
 * Implements hook_civicrm_buildForm()
 *
 * Just stash the contact ID away for later use.
 *
 * @link https://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_buildForm
 */
function transactional_civicrm_buildForm($formName, &$form) {
  CRM_Mailing_Transactional::singleton()->setFormContact($form->getContactID());
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function transactional_civicrm_config(&$config) {
  _transactional_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function transactional_civicrm_xmlMenu(&$files) {
  _transactional_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function transactional_civicrm_install() {
  _transactional_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function transactional_civicrm_uninstall() {
  _transactional_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function transactional_civicrm_enable() {
  _transactional_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function transactional_civicrm_disable() {
  _transactional_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function transactional_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _transactional_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function transactional_civicrm_managed(&$entities) {
  _transactional_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function transactional_civicrm_caseTypes(&$caseTypes) {
  _transactional_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function transactional_civicrm_angularModules(&$angularModules) {
_transactional_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function transactional_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _transactional_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function transactional_civicrm_preProcess($formName, &$form) {

}

*/
