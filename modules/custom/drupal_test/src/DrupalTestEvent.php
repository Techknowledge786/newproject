<?php

/**
 * @file
 * Contains \Drupal\blindd8\BlindD8NotableEvent.
 */

namespace Drupal\drupal_test;

use Symfony\Component\EventDispatcher\Event;

/**
 * Wraps a notable event for event listeners.
 */
class DrupalTestEvent extends Event {

  /**
   * A simple string
   *
   * @var string
   */
  protected $string;

  /**
   * Adds our string as a property to the event class.
   *
   * @param string
   *   A simple string.
   */
  public function __construct($string) {
    $this->string = $string;
  }

  /**
   * Gets the string.
   *
   * @return string
   *   The string that we're passing around.
   */
  public function getString() {
    return $this->string;
  }

  /**
   * Sets the string.
   *
   * @param $value
   *   The string that we're passing around.
   */
  public function setString($value) {
    $this->string = $value;
  }

}
