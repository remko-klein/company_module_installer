<?php

namespace CompanyModules\Composer;

use Exception;

/**
 * Simple class for our supported configurations.
 */
class Config {

  /**
   * The configuration (keys "path" and "prefix").
   *
   * @var array
   */
  protected static $type2config;

  /**
   * Initialize: load the configuration file.
   *
   * @throws \Exception
   *   Thrown when the JSON file couldn't be read or is invalid.
   */
  protected static function init() {
    self::$type2config = json_decode(file_get_contents(__DIR__ . '../../custom_modules.json'), TRUE);

    if (empty(self::$type2config)) {
      throw new Exception('Unable to parse custom modules list, invalid JSON?');
    }
  }

  /**
   * Gets the package type definition.
   *
   * @param string $packageType
   *   The package type.
   *
   * @return array|null
   *   The configuration (keys "path" and "prefix") or NULL when not found.
   *
   * @throws \Exception
   *   Thrown on exception when reading the config file.
   */
  public static function get($packageType) {
    self::init();
    return !empty(self::$type2config[$packageType]) ? self::$type2config[$packageType] : NULL;
  }

  /**
   * Is the package type supported?
   *
   * @param string $packageType
   *   The package type.
   *
   * @return bool
   *   TRUE if supported, FALSE when not.
   *
   * @throws \Exception
   *   Thrown on exception when reading the config file.
   */
  public static function isSupportedPackageType($packageType) {
    self::init();
    return in_array($packageType, array_keys(self::$type2config), TRUE);
  }

}
