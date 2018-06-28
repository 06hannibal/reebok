<?php

namespace Drupal\registration_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

/**
* @property  userAuth
*/
class FormRegistration extends FormBase {

  /**
   * @return string
   */
  public function getFormId() {
    return 'form registration';
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array|void
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['registration'] = [
      '#type' => 'fieldset',
      '#title' => t('БЫСТРАЯ РЕГИСТРАЦИЯ'),
      '#description' => t('Если Вы уже зарегистрированы, перейдите на страницу входа в систему.'),
    ];

    $form['information'] = [
      '#type' => 'fieldset',
      '#title' => t('ОСНОВНАЯ ИНФОРМАЦИЯ'),
    ];

    $form['email'] = [
      '#type' => 'email',
      '#required' => TRUE,
      '#title' => t('Email'),
      '#placeholder' => t('*Email'),
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => t('Имя'),
      '#placeholder' => t('*ИМЯ'),
    ];

    $form['surname'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => t('Фамилия'),
      '#placeholder' => t('*ФАМИЛИЯ'),
    ];

    $form['number'] = [
      '#type' => 'number',
      '#required' => TRUE,
      '#title' => t('Телефон'),
      '#placeholder' => t('*ТЕЛЕФОН'),
    ];

    $form['pass'] = [
      '#type' => 'password',
      '#required' => TRUE,
      '#title' => t('Пароль'),
      '#size' => 25,
    ];

    $form['pass2'] = [
      '#type' => 'password',
      '#required' => TRUE,
      '#title' => t('Подтвердить'),
      '#size' => 25,
    ];

    $form['address'] = [
      '#type' => 'fieldset',
      '#title' => t('ВАШ АДРЕС'),
    ];

    $terms_countries = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('country');

    foreach ($terms_countries as $term_country) {
      $options_country[$term_country->tid] = $term_country->name;
    }

    $form['country'] = [
      '#type' => 'select',
      '#options' => $options_country,
      '#title' => t('Страна'),
      '#empty_option' => '---выберите страну---',
      '#required' => true,
    ];

    $terms_regions = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('region');

    foreach ($terms_regions as $term_region) {
      $option_region[$term_region->tid] = $term_region->name;
    }

    $form['region'] = [
      '#type' => 'select',
      '#options' => $option_region,
      '#title' => t('Область'),
      '#empty_option' => '---выберите область---',
      '#required' => true,
    ];

    $terms_cities = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('city');

    foreach ($terms_cities as $term_city) {
      $option_city[$term_city->tid] = $term_city->name;
    }

    $form['city'] = [
      '#type' => 'select',
      '#options' => $option_city,
      '#title' => t('Область'),
      '#empty_option' => '---выберите область---',
      '#required' => true,
    ];

    $form['news'] = [
      '#type' => 'radios',
      '#options' => [
        'yes' => t('Да'),
        'no' => t('Нет'),
      ],
      '#title' => t('Подписаться на новости'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Продолжить'),
    ];

    return $form;
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $pass = $form_state->getValue('pass');
    $pass2 = $form_state->getValue('pass2');

    if ($pass!=$pass2) {
      $form_state->setErrorByName('pass', $this->t('Ваш пароль не соответствует.'));
    }

    if(strlen($pass) < 6 ) {
      $form_state->setErrorByName('pass', $this->t('Длина пароля должна содержать не менее 6 символов.'));
    }
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $email = $form_state->getValue('email');
    $name = $form_state->getValue('name');
    $surname = $form_state->getValue('surname');
    $number = $form_state->getValue('number');
    $pass = $form_state->getValue('pass');
    $country = $form_state->getValue('country');
    $region = $form_state->getValue('region');
    $city = $form_state->getValue('city');
    $news = $form_state->getValue('news');

  }

}