<?php

namespace Drupal\purchase_return\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @file
 * Contains \Drupal\purchase_return\Form\Purchasereturn.
 */
class Purchasereturn extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'purchase_return_id';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['return-goods'] = [
      '#markup' => '<div class="return-goods-title"><h3><i class="fa fa-reply"></i>Возврат товара</h3></div>',
      ];

    $form['description-title'] = [
      '#markup' => '<div class="description-title"><p>Пожалуйста, заполните форму на возврат товара.</p></div>',
    ];

    $form['information-title'] = [
      '#markup' => '<div class="information-title"><h3>Информация о заказе</h3></div>',
    ];

    $form['name'] = [
      '#title' => t('Имя:'),
      '#type' => 'textfield',
      '#required' => true,
      '#placeholder' => t('Имя:'),
    ];

    $form['surname'] = [
      '#type' => 'textfield',
      '#title' => t('Фамилия:'),
      '#required' => true,
      '#placeholder' => t('Фамилия:'),
    ];

    $form['email'] = [
      '#type' => 'email',
      '#required' => true,
      '#title' => t('E-Mail:'),
      '#placeholder' => t('E-Mail:'),
    ];

    $form['phone'] = [
      '#type' => 'number',
      '#required' => true,
      '#title' => t('Телефон:'),
      '#placeholder' => t('Телефон:'),
    ];

    $form['order'] = [
      '#type' => 'textfield',
      '#title' => t('№ заказа:'),
      '#required' => true,
      '#placeholder' => t('№ заказа:'),
    ];

    $form['date'] = [
      '#type' => 'textfield',
      '#title' => t('Дата заказа:'),
      '#placeholder' => t('Дата заказа:'),
      '#attributes' => [
        'id' => ['datepicker'],
      ],
      '#markup' => '<i class="fa fa-calendar"></i>',
    ];

    $form['information-goods-title'] = [
      '#markup' => '<div class="information-title"><h3>Информация о товаре и Причина возврата</h3></div>',
    ];

    $form['rename'] = [
      '#type' => 'textfield',
      '#title' => t('Наименование:'),
      '#required' => true,
      '#placeholder' => t('Наименование:'),
    ];

    $form['model'] = [
      '#type' => 'textfield',
      '#title' => t('Модель:'),
      '#required' => true,
      '#placeholder' => t('Модель:'),
    ];

    $form['amount'] = [
      '#type' => 'number',
      '#title' => t('Количество:'),
      '#placeholder' => t('Количество:'),
    ];

    $form['cause'] = [
      '#type' => 'radios',
      '#title' => t('Причина:'),
      '#options' => [
        'Другое (другая причина), пожалуйста, укажите/приложите подробности' => 'Другое (другая причина), пожалуйста, укажите/приложите подробности',
        'Ошибочный, пожалуйста, укажите/приложите подробности' => 'Ошибочный, пожалуйста, укажите/приложите подробности',
        'Получен не тот (ошибочный) товар' => 'Получен не тот (ошибочный) товар',
        'Получен/доставлен неисправным (сломанным)' => 'Получен/доставлен неисправным (сломанным)',
      ],
    ];

    $form['unpacked'] = [
      '#type' => 'radios',
      '#title' => t('Распакован:'),
      '#options' => [
        'Да' => 'Да',
        'Нет' => 'Нет',
      ],
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => t('Описание:'),
      '#placeholder' => t('Описание:'),
    ];

    $form['back-button'] = [
      '#markup' => '<div class="back-left"><a href="/home" class="back-left-link">Назад</a></div>',
    ];

    $form['checkbox'] = [
      '#title' => 'МНОЮ ПРОЧИТАНЫ И Я ДАЮ СОГЛАСИЕ С ДОКУМЕНТОМ ВОЗВРАТ И ГАРАНТИЯ',
      '#type' => 'checkbox',
    ];

    $form['submit']['checkbox'] = [
      '#type' => 'submit',
      '#value' => t('Отправить'),
      '#prefix' => '<div class="finish-right">',
      '#suffix' => '</div>',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $checkbox = $form_state->getValue('checkbox');

    if (!$checkbox == TRUE) {
      $form_state->setErrorByName('news', $this->t('Вы не дали согласия с документом возврата и гарантии.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $to = '06hannibal@gmail.com';

    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'purchase_return';
    $key = 'return_goods';

    $params['title'] = 'дание про товар';

    $name = $form_state->getValue('name');
    $surname = $form_state->getValue('surname');
    $email = $form_state->getValue('email');
    $phone = $form_state->getValue('phone');
    $order = $form_state->getValue('order');
    $date = $form_state->getValue('date');
    $rename = $form_state->getValue('rename');
    $model = $form_state->getValue('model');
    $amount = $form_state->getValue('amount');
    $cause = $form_state->getValue('cause');
    $unpacked = $form_state->getValue('unpacked');
    $description = $form_state->getValue('description');

    $params['body'] = [
      'name' => $name,
      'surname' => $surname,
      'email' => $email,
      'phone' => $phone,
      'order' => $order,
      'date' => $date,
      'rename' => $rename,
      'model' => $model,
      'amount' => $amount,
      'cause' => $cause,
      'unpacked' => $unpacked,
      'description' => $description,
    ];

    $send = TRUE;

    $mail = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

    if (!$mail) {
      drupal_set_message(t('извините ваше письмо не отправлено.'), 'error');
    } else {
      drupal_set_message(t('Cпасибо наш менеджер свяжется с вами - Reebok Украина!.'));
    }

  }
}
