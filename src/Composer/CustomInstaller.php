<?php

namespace CompanyModules\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use InvalidArgumentException;

/**
 * Our custom installer for the supported configurations.
 *
 * @see \CompanyModules\Composer\Config
 */
class CustomInstaller extends LibraryInstaller {

  /**
   * {@inheritdoc}
   */
  public function getInstallPath(PackageInterface $package) {
    $packageConfig = Config::get($package->getType());

    if ($packageConfig === NULL) {
      $msg = sprintf('Unable to install module "%s"; unsupported type "%s"', $package->getPrettyName(), $package->getType());
      throw new InvalidArgumentException($msg);
    }

    $supportedPrefix = $packageConfig['prefix'];
    $actualPrefix = substr($package->getPrettyName(), 0, strlen($supportedPrefix));

    if ($supportedPrefix !== $actualPrefix) {
      $msg = sprintf('Unable to install module "%s" of type "%s" due to unsupported naming convention.  Name should start with "%s"',
        $package->getPrettyName(), $package->getType(), $supportedPrefix);
      throw new InvalidArgumentException($msg);
    }

    return $packageConfig['path'] . substr($package->getPrettyName(), strlen($actualPrefix));
  }

  /**
   * {@inheritdoc}
   */
  public function supports($packageType) {
    return Config::isSupportedPackageType($packageType);
  }

}
