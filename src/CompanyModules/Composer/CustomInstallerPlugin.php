<?php

namespace CompanyModules\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Register a custom installer for composer.
 */
class CustomInstallerPlugin implements PluginInterface {

  /**
   * {@inheritdoc}
   */
  public function activate(Composer $composer, IOInterface $io) {
    $installer = new CustomInstaller($io, $composer);
    $composer->getInstallationManager()->addInstaller($installer);
  }

}
