<p>
<?php echo link_to('プライバシーポリシー', 'default/privacyPolicy', array('target' => '_blank')); ?> 
<?php echo link_to('利用規約', 'default/userAgreement', array('target' => '_blank')); ?> 
<?php $snsConfigSettings = sfConfig::get('openpne_sns_config'); ?>
<?php if (opToolkit::isSecurePage()) : ?>
<?php echo Doctrine::getTable('SnsConfig')->get('footer_after', $snsConfigSettings['footer_after']['Default']); ?>
<?php else: ?>
<?php echo Doctrine::getTable('SnsConfig')->get('footer_before', $snsConfigSettings['footer_before']['Default']); ?>
<?php endif; ?>
</p>
