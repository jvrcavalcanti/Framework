<?php

namespace Pendragon\Framework;

use Accolon\Route\Router as AccolonRouter;
use Pendragon\Framework\Exceptions\PendragonException;
use Pendragon\Framework\Exceptions\ValidateFailException;
use Accolon\Izanami\Exceptions\FailQueryException;
use Accolon\Route\Request;

class Router extends AccolonRouter
{
    public function runMiddlewares(Request $request)
    {
        try {
            return parent::runMiddlewares($request);
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
