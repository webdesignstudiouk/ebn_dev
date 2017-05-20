<?php
namespace CheatCodes\LaravelWhoops;

use App\Exceptions\Handler;
use Exception;
use Request;
use Whoops\Run as Whoops;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

class WhoopsExceptionHandler extends Handler
{
	/**
	 * Get the Whoops Handler instance to use
	 *
	 * @return \Whoops\Handler\Handler
	 */
	protected function getWhoopsHandler()
	{
		$ajaxResponse = (Request::ajax() || Request::wantsJson());

		return $ajaxResponse ? new JsonResponseHandler() : new PrettyPageHandler();
	}

	/**
	 * Create a Whoops response for the given exception
	 *
	 * @param Exception $e
	 * @return \Illuminate\Http\Response
	 */
	protected function convertExceptionToWhoops(Exception $e)
	{
		$whoops = new Whoops();
		$whoops->pushHandler($this->getWhoopsHandler());

		$statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
		$headers = method_exists($e, 'getHeaders') ? $e->getHeaders() : [];

		return response()->make($whoops->handleException($e), $statusCode, $headers);
	}

	/**
	 * Create the default or a Whoops response for the given exception
	 *
	 * @param Exception $e
	 * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
	 */
	protected function convertExceptionToResponse(Exception $e)
	{
		return config('app.debug')
			? $this->convertExceptionToWhoops($e)
			: parent::convertExceptionToResponse($e);
	}
}
