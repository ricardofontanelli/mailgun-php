<?php

/**
 * Copyright (C) 2013-2016 Mailgun.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */
namespace Mailgun\Resource\Api\Domain;

use Mailgun\Assert;
use Mailgun\Resource\CreatableFromArray;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
class DeliverySettingsResponse implements CreatableFromArray
{
    /**
     * @var bool
     */
    private $noVerify;

    /**
     * @var bool
     */
    private $requireTLS;

    /**
     * @param array $data
     *
     * @return DeliverySettingsResponse
     */
    public static function createFromArray(array $data)
    {
        Assert::keyExists($data, 'connection');
        Assert::isArray($data['connection']);
        $connSettings = $data['connection'];

        Assert::keyExists($connSettings, 'skip_verification');
        Assert::keyExists($connSettings, 'require_tls');

        return new static(
            $connSettings['skip_verification'],
            $connSettings['require_tls']
        );
    }

    /**
     * @param bool $noVerify   Disable remote TLS certificate verification
     * @param bool $requireTLS Requires TLS for all outbound communication
     */
    public function __construct($noVerify, $requireTLS)
    {
        $this->noVerify = $noVerify;
        $this->requireTLS = $requireTLS;
    }

    /**
     * @return bool
     */
    public function getSkipVerification()
    {
        return $this->noVerify;
    }

    /**
     * @return bool
     */
    public function getRequireTLS()
    {
        return $this->requireTLS;
    }
}
