<?php

namespace Drupal\drupal_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Drupal\drupal_test\DrupalTestEvent;

use Drupal\bootcamp\MessageTest;

/**
 * Class DrupalTestController.
 */
class DrupalTestController extends ControllerBase {

  /**
   * Drupal\Core\Database\Connection definition.
   *
   * @var \Drupal\Core\Database\Connection;
   */
  protected $database;
  /**
   * Drupal\Core\Logger\LoggerChannelFactoryInterface definition.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $loggerFactory;
  /**
   * An event dispatcher instance to use for configuration events.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  protected $messageTest;

  /**
   * Constructs a new DrupalTestController object.
   */
  public function __construct(Connection $database, LoggerChannelFactoryInterface $logger_factory, EventDispatcherInterface $event_dispatcher, MessageTest $message_test) {
    $this->database = $database;
    $this->loggerFactory = $logger_factory;
    $this->eventDispatcher = $event_dispatcher;
    $this->messageTest = $message_test;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('logger.factory'),
      $container->get('event_dispatcher'),
      $container->get('bootcamp.message_test')
    );
  }

  /**
   * Drupal_test.
   *
   * @return string
   *   Return Hello string.
   */
  public function drupalTest() {

//    drupal_set_message($this->messageTest->message());
//
//    $connection = $this->database->query("SELECT name from {users_field_data} where uid = 1")->fetchField();
//    return [
//      '#type' => 'markup',
//      '#markup' => $this->t('Implement method: drupal_test ') . $connection,
//    ];

//    $subject = ''; // Normally this would be an object that includes methods we can use. For now, we'll just use arguments.
//    $arguments = array('string' => 'This is the default string');
//    $event = new GenericEvent($subject, $arguments);
//    $this->eventDispatcher->dispatch('drupal_test.test_event', $event);
//    $string = $event->getArgument('string');
    
      $string = 'This is the default string';
      $event = new DrupalTestEvent($string);
      \Drupal::service('event_dispatcher')->dispatch('drupal_test.test_event', $event);
      $string = $event->getString();
    
    
    return [
      '#markup' => $this->t('Hello world!  @string', array('@string' => $string))
    ];
  }

}
