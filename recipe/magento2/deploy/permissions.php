<?php

namespace Deployer;

////////////////////////////////////////////////////////////////////////////////
desc('Add file owner to apache group and back');
task('magento2:deploy:usermod', function () {
    $group = get('httpuser');
    $user = get('owner');
    run("{{bin/sudo}} usermod -a -G $group $user");
    run("{{bin/sudo}} usermod -a -G $user $group");
})->setPrivate();

////////////////////////////////////////////////////////////////////////////////
desc('Set file permissions for current magento 2 instance');
task('magento2:deploy:permissions', function () {
    $user = get('owner');
    $group = get('httpuser');

    $commands = array(
        "{{bin/sudo}} chown -R $user:$group . ",
        "{{bin/sudo}} find . -type d -exec chmod 770 {} \; ",
        "{{bin/sudo}} find . -type f -exec chmod 660 {} \; ",
        //"{{bin/sudo}} find . -type l -exec chmod 660 {} \; ",
         "{{bin/sudo}} chmod u+x {{bin/magento}} ",
        //"{{bin/sudo}} chmod g+x {{bin/magento}} ",
        //"{{bin/sudo}} chmod -R g+w {app/etc,pub,var,vendor}",
        "{{bin/sudo}} chmod -R g+w app/etc ",
        "{{bin/sudo}} chmod -R g+w pub",
        "{{bin/sudo}} chmod -R g+w var"
    );
    foreach ($commands as $command) {
        run("cd {{release_path}} && " . $command);
    }
})->setPrivate();