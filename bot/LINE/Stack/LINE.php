<?php

namespace LINE\Stack;

defined("CHANNEL_SECRET") or die;
defined("CHANNEL_ACCESS_TOKEN") or die;

class LINE
{
	/**
	 * @param array $messages
	 * @param string $replyToken
	 */
	public static function reply($messages, $replyToken)
	{
		return self::exec("https://api.line.me/v2/bot/message/reply" , array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => json_encode(array(
						"replyToken" => $replyToken,
						"messages" => $messages
					), 128),
				CURLOPT_HTTPHEADER => array(
						"Content-Type:application/json",
						"Authorization: Bearer ".CHANNEL_ACCESS_TOKEN
					),
				CURLOPT_BINARYTRANSFER => true
			));
	}

	private static function exec($url, $op)
	{
		$ch = curl_init($url);
		curl_setopt_array($ch, $op);
		$out = curl_exec($ch);
		$err = curl_error($ch) and $out = $err;
		curl_close($ch);
		var_dump($out);
		return $out;
	}
}