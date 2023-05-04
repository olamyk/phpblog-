<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'mt1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '74805079b50439d3fdec',
    '0d8a53b2358486e4f1be',
    '1457038',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
?>