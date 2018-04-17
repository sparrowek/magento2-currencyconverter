<?php
//registering magento's module
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE, 'Test_CurrencyConverter', __DIR__
);

//register autoloader for JMS Serializer annotations
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
