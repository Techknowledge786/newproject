<?php

namespace Drupal\drupal_test;

use Drupal\Core\Database\Connection;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class MessageTest.
 */
class MessageTest implements MessageTestInterface {

  /**
   * Drupal\Core\Database\Connection; definition.
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
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Constructs a new EventDefaultSubscriber object.
   */
  public function __construct(Connection $database, LoggerChannelFactoryInterface $logger_factory, RequestStack $request_stack) {
    $this->database = $database;
    $this->loggerFactory = $logger_factory;
    $this->requestStack = $request_stack;
  }

  /**
   * {@inheritdoc}
   */
  public function message() {
    $name = $this->database->query("SELECT name from {users_field_data} where uid = 1")->fetchField();
    $this->loggerFactory->get('default')->critical("Service called: " . $name);
    return "Service called: " . $name;
  }

  public function message2() {
    $this->loggerFactory->get('default')->critical("Service called: message2");
    return "Service called: message2";
  }

}
