<?php

namespace Drupal\file2media\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for Files (images only).
 *
 * @MigrateSource(
 *   id = "d8_file_image",
 *   source_provider = "file2media"
 * )
 */
class FileImage extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    return $this->select('file_managed')
      ->fields('file_managed', array_keys($this->fields()))
      ->condition('file_managed.filemime', 'image%', 'LIKE');
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'fid' => $this->t('File ID'),
      'langcode' => $this->t('Langcode'),
      'uid' => $this->t('User ID'),
      'filename' => $this->t('File name'),
      'uri' => $this->t('File URI'),
      'filemime' => $this->t('File MIME type'),
      'filesize' => $this->t('File size in bytes'),
      'status' => $this->t('File status'),
      'created' => $this->t('File created timestamp'),
      'changed' => $this->t('File changed timestamp'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'fid' => [
        'type' => 'integer',
      ],
    ];
  }

}
