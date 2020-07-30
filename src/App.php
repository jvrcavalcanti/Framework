<?php

namespace Pendragon\Framework;

use Accolon\Route\Router;
use Pendragon\Framework\Exceptions\PendragonException;
use Pendragon\Framework\Exceptions\ValidateFailException;
use Accolon\DataLayer\Exceptions\FailQueryException;
use Pendragon\Framework\Container;

class App extends Router
{
    use Container;

    public function run()
    {
        try {
            return parent::run();
        } catch (ValidateFailException $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], $e->getCode());
        } catch (FailQueryException $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        } catch (PendragonException $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], $e->getCode());
        }
    }
}
