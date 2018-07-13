<?php

namespace Deployer;

require_once __DIR__ . '/recipe/common.php';
require_once __DIR__ . '/recipe/skeleton/magento1.php';
require_once __DIR__ . '/recipe/skeleton/magento2.php';

set('keep_releases', 30);
set('shared_dirs', []);
set('shared_files', []);
set('ssh_type', 'native');

inventory('hosts.yml');
