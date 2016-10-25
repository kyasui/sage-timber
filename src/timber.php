<?php

if (!class_exists('Timber')) {
    add_action('admin_notices', function () {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
    });
    return;
}

Timber::$dirname = ['templates', 'views'];

class SageTwigSite extends TimberSite
{
    function __construct()
    {
        add_filter('timber_context', array($this, 'add_to_context'));
        parent::__construct();
    }

    function add_to_context($context)
    {
        $context['menu'] = new TimberMenu();
        $context['site'] = $this;
        return $context;
    }
}

new SageTwigSite();
