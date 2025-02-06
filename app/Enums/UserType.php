<?php

namespace App\Enums;

enum UserType: string
{
    case USER = 'user';
    case SUPER_ADMIN = 'superAdmin';
    case ADMIN = 'admin';
    case CAFE = 'cafe';
    case BOOTH = 'booth';
    case RESTAURANT = 'restaurant';
    case RESTAURANT_EMPLOYEE = 'restaurantEmployee';
    case CAFE_EMPLOYEE = 'cafeEmployee';
    case BOOTHS_EMPLOYEE = 'boothEmployee';
    case WORKER = 'worker';
}
