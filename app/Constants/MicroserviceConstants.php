<?php

namespace App\Constants;

class MicroserviceConstants
{
    private static function getBaseUrl(string $serviceKey): string
    {
        $environment = config('app.env');
        return config("services.microservices.{$serviceKey}.{$environment}");
    }

    public static function getUsersServiceUrl(): string
    {
        return self::getBaseUrl('user_service');
    }

    public static function getFacilitiesServiceUrl(): string
    {
        return self::getBaseUrl('facilities_service');
    }

}
