<?php

namespace Pendragon\Framework\Auth;

use Accolon\Izanami\Model;

abstract class Authenticatable extends Model
{
    use HasApiToken;
}
