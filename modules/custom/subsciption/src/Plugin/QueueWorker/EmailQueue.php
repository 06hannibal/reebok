<?php

/**
 * @file
 * Contains \Drupal\subscription\Plugin\QueueWorker\EmailQueue.
 */
namespace Drupal\subscription\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;

/**
 * Processes Tasks for Learning.
 *
 * @QueueWorker(
 *   id = "subscribe_news",
 *   title = @Translation("Learning task worker: email queue"),
 *   cron = {"time" = 60}
 * )
 */
class EmailQueue extends QueueWorkerBase {

  /**
   * {@inheritdoc}
   */
  public function processItem($item) {

      $langcode = \Drupal::currentUser()->getPreferredLangcode();
      $to = $item['mail'];

      $mailManager = \Drupal::service('plugin.manager.mail');

      $module = 'subscription';
      $key = 'subscribe_news';

      $params['title'] = $item['title'];

      $name = $item['name'];
      $body = $item['body'];

      $params['body'] = [
        'name' => $name,
        'body' => $body,
        ];

      $send = TRUE;

      $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
  }
}