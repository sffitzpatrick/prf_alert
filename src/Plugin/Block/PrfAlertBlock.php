<?php

namespace Drupal\prf_alert\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a configurable text string block.
 *
 * Drupal\Core\Block\BlockBase gives us a very useful set of basic functionality
 * for this configurable block. We can just fill in a few of the blanks with
 * defaultConfiguration(), blockForm(), blockSubmit(), and build().
 *
 * @Block(
 *   id = "prf_alert_block",
 *   admin_label = @Translation("Sitewide Alert")
 * )
 */
class PrfAlertBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return ['label_display' => FALSE];
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        $form['prf_alert_block_text'] = array(
            '#type' => 'text_format',
            '#title' => $this->t('Alert text'),
            '#default_value' => isset($config['prf_alert_block_text']) ? $config['prf_alert_block_text']['value'] : '',
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['prf_alert_block_text'] = $form_state->getValue('prf_alert_block_text');
    }

    /**
     * Build the alert block
     * @param  array $config  array of block configs
     * @return markup          array of rendered events
     */
    public function build() {
        $config = $this->getConfiguration();
        $alert_text = $config['prf_alert_block_text'];
        $build = array(
          '#theme' =>  'prf_alert_block',
          '#content' => $alert_text['value']
        );
        return $build;
    }

}
