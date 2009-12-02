<?php $onlines = $this->requestAction('/online/onlines'); ?>
<? if(!empty($onlines)): ?>
<div class="onlines">
  <? foreach($onlines as $online): ?>
    <div class="online">
      <p class="url"><?= $online['Online']['url']; ?></p>
      <p class="time"><?= $online['Online']['modified']; ?></p>
    </div>
  <? endforeach; ?>
</div>
<? endif; ?>
