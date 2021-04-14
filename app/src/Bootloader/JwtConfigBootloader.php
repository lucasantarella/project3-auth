<?php


namespace App\Bootloader;


use App\Middleware\LocaleSelector;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Http\HttpBootloader;
use Spiral\Config\ConfiguratorInterface;
use Spiral\Core\Container;
use Spiral\Core\Container\SingletonInterface;

class JwtConfigBootloader extends Bootloader implements SingletonInterface
{
    /**
     * @var ConfiguratorInterface $config
     */
    private $config;


    /**
     * @param ConfiguratorInterface $config
     */
    public function __construct(ConfiguratorInterface $config)
    {
        $this->config = $config;
    }

    /**
     * Init database config.
     * @param Container $container
     */
    public function boot(Container $container): void
    {
        $this->config->setDefaults(
            'jwt',
            [
                'public_key' => env('JWT_PUBLIC_KEY_PATH', 'pubkey.pem'),
                'private_key' => env('JWT_PRIVATE_KEY_PATH', 'privkey.pem'),
            ]
        );

        $config = $this->config->getConfig('jwt');
        $container->bindSingleton(Configuration::class, function () use ($config) {
            return Configuration::forAsymmetricSigner(
                new Signer\Rsa\Sha256(),
                Signer\Key\InMemory::file($config['private_key']),
                Signer\Key\InMemory::file($config['public_key']),
            );
        });
    }

}
