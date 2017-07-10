<?php if (!empty($seo['title'])): ?>
    <title><?php echo $seo['title']; ?></title>
    <meta name="title" content="<?php echo $seo['title']; ?>" />
<?php endif; ?>
<?php if (!empty($seo['description'])): ?>
    <meta name="description" content="<?php echo $seo['description']; ?>" />
<?php endif; ?>
<?php if (!empty($seo['keywords'])): ?>
    <meta name="keywords" content="<?php echo $seo['keywords']; ?>" />
<?php endif; ?>
<?php if (!empty($seo['robots'])): ?>
    <meta name="robots" content="<?php echo $seo['robots']; ?>" />
<?php endif; ?>
<?php if (!empty($seo['rel_canonical'])): ?>
    <link rel="canonical" href="<?php echo $seo['rel_canonical']; ?>" />
<?php endif; ?>
<script type="text/javascript">
    var $_LANGUAGE = '<?php echo($_CONFIGS['current_language']); ?>';
</script>
<?php echo $this->Html->script('plugins/i18n'); ?>
