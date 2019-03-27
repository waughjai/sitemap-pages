<?php

declare( strict_types = 1 );
namespace WaughJ\SitemapPages
{
	use WaughJ\Directory\Directory;

	class SitemapPageResponse
	{
		public function __construct( string $url )
		{
			$this->url = $url;
			$ch = curl_init( $this->url );
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:64.0) Gecko/20100101 Firefox/64.0');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			$this->body = curl_exec( $ch );
			$this->content_type = curl_getinfo( $ch, CURLINFO_CONTENT_TYPE );
			curl_setopt($ch, CURLOPT_HEADER, false);
			$this->body = curl_exec( $ch );
			curl_close( $ch );
		}

		public function getBody()
		{
			return $this->body;
		}

		public function isXML() : bool
		{
			return $this->content_type !== false && strpos( $this->content_type, 'xml' ) !== false;
		}

		private $url;
		private $body = false;
		private $content_type;
	}
}
