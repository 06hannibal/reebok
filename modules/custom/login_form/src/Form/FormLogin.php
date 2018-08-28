<?php

namespace Drupal\login_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\user\Entity\User;


/**
 * Class FormLogin
 * @package Drupal\registration_form\Form
 */
class FormLogin extends FormBase {

  /**
   * @return string
   */
  public function getFormId() {
    return 'form login';
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['authorization-login-title'] = [
      '#markup' => t('<div class="authorization-login-title"><h3>АВТОРИЗАЦИЯ</h3></div>'),
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#required' => true,
    ];

    $form['pass'] = [
      '#type' => 'password',
      '#required' => TRUE,
      '#size' => 25,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Войти'),
    ];
    $form['check_in'] = [
      '#title' => t('Регистрация'),
      '#type' => 'link',
      '#url' => Url::fromRoute('registration_form.form'),
    ];
    $form['Forgot_your_password'] = [
      '#title' => t('Забыли пароль?'),
      '#type' => 'link',
      '#url' => Url::fromRoute('user.logout'),
    ];

    return $form;
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $name = $form_state->getValue('name');
    $pass = $form_state->getValue('pass');

    $uid = \Drupal::service('user.auth')->authenticate($name, $pass);
    $user = User::load($uid);
    user_login_finalize($user);

    drupal_set_message(t("login to the system."), 'status');
    $form_state->setRedirect('<front>');
  }
}