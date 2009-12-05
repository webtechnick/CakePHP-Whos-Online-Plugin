<?php $onlines = $this->requestAction('/online/onlines'); ?>
<div class="index onlines">
<h1>Who's Online</h1>
<? if(!empty($onlines)): ?>
<table id="onlines" cellspacing="0" cellpadding="0">
  <tr>
    <th>IP</th>
    <th>URL</th>
    <th>Time</th>
  </tr>
<? foreach($onlines as $ol): ?>
  <tr>
    <td class="real_ip"><?= $html->link($ol['Online']['real_ip'], "http://whois.domaintools.com/{$ol['Online']['real_ip']}"); ?></td>
    <td class="url"><?= $html->link($ol['Online']['url'], $ol['Online']['url']); ?></td>
    <td class="time"><?= $ol['Online']['modified']; ?></td>
  </tr>
<? endforeach; ?>
</table>
<? endif; ?>
</div>