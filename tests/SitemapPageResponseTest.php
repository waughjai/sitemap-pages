<?php

use PHPUnit\Framework\TestCase;
use WaughJ\SitemapPages\SitemapPageResponse;

class SitemapPageResponseTest extends TestCase
{
	public function testPage()
	{
		$response = new SitemapPageResponse( 'https://www.google.com/sitemap.xml' );
		$this->assertContains( '<sitemapindex xmlns="http://www.google.com/schemas/sitemap/0.84">', $response->getBody() );
	}

	public function testIsXML()
	{
		$response = new SitemapPageResponse( 'https://www.google.com/sitemap.xml' );
		$this->assertTrue( $response->isXML() );
		$response2 = new SitemapPageResponse( 'https://www.google.com' );
		$this->assertFalse( $response2->isXML() );
	}
}
