<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Notifier\Bridge\GoIP\Tests;

use Symfony\Component\Notifier\Bridge\GoIP\GoIPTransportFactory;
use Symfony\Component\Notifier\Test\TransportFactoryTestCase;

/**
 * @author Ahmed Ghanem <ahmedghanem7361@gmail.com>
 */
final class GoIPTransportFactoryTest extends TransportFactoryTestCase
{
    public static function createProvider(): iterable
    {
        yield [
            'goip://host.test:9000?sim_slot=31',
            'goip://user:pass@host.test:9000?sim_slot=31',
        ];
    }

    public static function supportsProvider(): iterable
    {
        yield [true, 'goip://root:root@host.test:9000?sim_slot=31'];
        yield [false, 'somethingElse://root:root@host.test:9000?sim_slot=31'];
    }

    public static function unsupportedSchemeProvider(): iterable
    {
        yield ['somethingElse://user:pass@host.test?sim_slot=2'];
    }

    public static function incompleteDsnProvider(): iterable
    {
        yield 'missing username or password' => ['goip://host.test?sim_slot=4'];
    }

    public static function missingRequiredOptionProvider(): iterable
    {
        yield 'missing required option: sim_slot' => ['goip://user:pass@host.test'];
    }

    public function createFactory(): GoIPTransportFactory
    {
        return new GoIPTransportFactory();
    }
}
