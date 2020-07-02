<?php

namespace Drupal\drupal_test\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Drupal\Core\Database\Connection;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
//use Symfony\Component\EventDispatcher\GenericEvent;
use Drupal\drupal_test\DrupalTestEvent;

/**
 * Class EventDefaultSubscriber.
 */
class EventDefaultSubscriber implements EventSubscriberInterface {

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
  static function getSubscribedEvents() {
    $events = [];

    //$events[KernelEvents::REQUEST] = ['onKernelRequest'];

    $events['drupal_test.test_event'][] = array('onTestEvent');

    return $events;
  }

  /**
   * This method is called whenever the kernel.request event is dispatched.
   *
   * @param GetResponseEvent $event
   *   GetResponseEvent event.
   */
  public function onKernelRequest(GetResponseEvent $event) {
    $request = $event->getRequest();
    $is_event = $request->query->get('is_event');
    if ($is_event) {
      $route_name = $this->requestStack->getCurrentRequest()->get(RouteObjectInterface::ROUTE_NAME);
      drupal_set_message('Event kernel.request thrown by Subscriber in module drupal_test: ' . $route_name, 'warning', TRUE);
    }
  }

  /**
   * Test event.
   *
   * @param GenericEvent $event
   *   GenericEvent event.
   */
//  public function onTestEvent(GenericEvent $event) {
//    $event->setArgument('string', 'Updated string!');
//  }
  
  
  /**
   * Test event.
   *
   * @param GenericEvent $event
   *   GenericEvent event.
   */
  public function onTestEvent(DrupalTestEvent $event) {
    $event->setString('Custom events, Updated string!');
  }

}
