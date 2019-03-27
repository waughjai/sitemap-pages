<?php

declare( strict_types = 1 );
namespace WaughJ\SitemapPages
{
	use \SimpleXMLElement;

	class SitemapPages
	{
		public function __construct( string $url )
		{
			$this->url = $url;
			$this->list = self::generatePageList( $url );
		}

		public function getPageList()
		{
			return $this->list;
		}

		private static function generatePageList( string $url ) : array
		{
			$list = [];
			$sitemap = new SitemapPageResponse( $url );
			$content = $sitemap->getBody();
			$data = new SimpleXMLElement( $content );
			$link_list = self::findLinkList( $data );
			foreach ( $link_list as $link )
			{
				$link_url = ( string )( $link );
				$link_url_response = new SitemapPageResponse( $link_url );
				if ( $link_url_response->isXML() )
				{
					$list = array_merge( $list, self::generatePageList( $link_url ) );
				}
				else
				{
					$list[] = $link_url;
				}
			}

			return $list;
		}

		private static function findLinkList( SimpleXMLElement $data )
		{
			$data = self::prepareXMLDataForXPath( $data );
			return $data->xpath( '//' . self::PREFIX . ':loc' );
		}

		private static function prepareXMLDataForXPath( SimpleXMLElement $data ) : SimpleXMLElement
		{
			// I don't know why this is necessary, but it is.
			// Came from https://www.php.net/manual/en/simplexmlelement.xpath.php
			foreach ( $data->getDocNamespaces() as $prefix => $namespace )
			{
				if ( strlen( $prefix ) == 0 )
				{
					$prefix = self::PREFIX; //Assign an arbitrary namespace prefix.
				}
				$data->registerXPathNamespace( $prefix, $namespace );
			}
			return $data;
		}

		private $list = false;

		private const PREFIX = "a";
	}
}
