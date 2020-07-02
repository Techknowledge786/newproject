<?php
/**
 * @file
 * Contains Drupal\ajax_example\AjaxExampleForm
 */

namespace Drupal\ajax_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

class AjaxExampleForm extends FormBase {

  public function getFormId() {
    return 'ajax_example_form';
  }
public function buildForm(array $form, FormStateInterface $form_state) {
   $form['massage'] = [
      '#type' => 'markup',
      '#markup' => '<div class="result_message"></div>',
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
    ];

    $form['gender'] = [
      '#type' => 'select',
      '#options' => ['Male','Female','Other'],
      '#title' => $this->t('Gender'),
    ];

    $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone Number'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email ID'),
      '#required' => TRUE,
    ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
    ];

    $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Submit'),
      '#ajax' => [
        'callback' => '::setMessage',
      ]
    ];
    return $form;
  }
  public function setMessage(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    $response->addCommand(
      new HtmlCommand(
        '.result_message',
        '<div class="my_top_message">' . $this->t('Hello '.$form_state->getValue('name').', Your Data is saved..')
        )
    );
      
}