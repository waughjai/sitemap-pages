<?php

declare( strict_types = 1 );
namespace WaughJ\SitemapPages
{
	class SitemapPages
	{
		public function __construct( string $url )
		{
			$this->url = $url;
			$sitemap = new SitemapPageResponse( $url );
			$content = $sitemap->getBody();
			$data = new \SimpleXMLElement( $content );
			$this->list = [];
			foreach ( $data->sitemap as $link )
			{
				$this->list[] = $link->loc;
			}
		}

		public function getPageList()
		{
			return $this->list;
		}

		private function generateList( array $list ) : array
		{
			foreach ( $list as $item )
			{
				$url = $item->loc;
			}
		}

		private $list = false;
	}
}
