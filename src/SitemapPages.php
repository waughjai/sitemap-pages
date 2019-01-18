<?php

declare( strict_types = 1 );
namespace WaughJ\SitemapPages
{
	use WaughJ\Directory\Directory;

	class SitemapPages
	{
		public function __construct( string $url )
		{
			$this->url = $url;
		}

		public function getText() : string
		{
			return $this->getContent();
		}

		public function getPageList() : array
		{
			return ( $this->list === null ) ? $this->setList() : $this->list;
		}

		private function getContent() : string
		{
			return ( $this->content === null ) ? $this->setContent() : $this->content;
		}

		private function setList() : array
		{
			$content = $this->getContent();
			$data = new \SimpleXMLElement( $content );
			$this->list = [];
			foreach ( $data->sitemap as $link )
			{
				$this->list[] = $link->loc;
			}
			return $this->list;
		}

		private function setContent() : string
		{
			$ch = curl_init( $this->url );
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:64.0) Gecko/20100101 Firefox/64.0');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			$output = curl_exec( $ch );
			$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
			if ( strpos( $content_type, 'xml' ) === false )
			{
				$new_url = new Directory([ $this->url, 'sitemap.xml' ]);
				$new_url = $new_url->getString([ 'starting-slash' => false, 'ending-slash' => false ]);
				curl_setopt($ch, CURLOPT_URL, $new_url);
				$output = curl_exec( $ch );
			}
			$this->content = $output;
			curl_close( $ch );
			return $this->content;
		}

		private $url;
		private $content = null;
		private $list = null;
	}
}
