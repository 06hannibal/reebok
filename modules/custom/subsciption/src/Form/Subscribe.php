<?php

namespace Drupal\subscription\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @file
 * Contains \Drupal\subscription\Form\Subscribe.
 */
class Subscribe extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'subscribe_id';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['email'] = [

      '#type' => 'email',
      '#required' => TRUE,
      '#title' => t('Подпишись на рассылку новостей reebok'),
      '#placeholder' => t('Ваш адрес электронной почты'),

    ];

    $form['submit'] = [

      '#type' => 'submit',
      '#value' => t('Подписаться'),

    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $user = \Drupal::database()->select('users_field_data', 'ufd');
    $user->Join('user__field_news', 'ufn', 'ufd.uid = ufn.entity_id');
    $user->fields('ufd', ['name']);
    $is_user = $user->condition('ufd.mail', $form_state->getValue('email'))
      ->execute()
      ->fetchField();

    $user_system = \Drupal::currentUser()->getAccountName();

    if ($is_user != $user_system) {
      $form_state->setErrorByName('name', $this->t('Sign in with your subscriber to subscribe to news.'));
    }

    $mail = \Drupal::database()->select('users_field_data', 'ufd');
    $is_mail = $mail
      ->condition('ufd.mail', $form_state->getValue('email'))
      ->countQuery()
      ->execute()
      ->fetchField();

    if (!$is_mail) {
      $form_state->setErrorByName('email', $this->t('Such user does not exist.'));
    }

    $checkbox = \Drupal::database()->select('user__field_news', 'ufn');
    $checkbox->Join('users_field_data', 'ufd', 'ufn.entity_id = ufd.uid');
    $checkbox->fields('ufn', ['field_news_value']);
    $is_checkbox = $checkbox->condition('ufd.mail', $form_state->getValue('email'))
      ->execute()
      ->fetchField();

    if ($is_checkbox == TRUE) {
      $form_state->setErrorByName('news', $this->t('You are already subscribed to the news.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $account = user_load_by_mail($form_state->getValue('email'));
    $account->get('field_news')->setValue(True);
    $account->save();

    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $to = $form_state->getValue('email');

    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'subscription';
    $key = 'mail';

    $params['title'] = \Drupal::currentUser()->getAccountName();

    $body = "Благодарим за подписку в reebok - Reebok Украина!";

    $params['body'] = [
      'body' => $body,
    ];
    $send = TRUE;

    $mail = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

    // processing the result.
    if (!$mail) {
      drupal_set_message(t('There was a problem sending your message and it was not sent.'), 'error');
    } else {
      drupal_set_message(t('Your message has been sent.'));
    }
  }
}
