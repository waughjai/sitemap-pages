<?php

use PHPUnit\Framework\TestCase;
use WaughJ\SitemapPages\SitemapPages;

class SitemapPagesTest extends TestCase
{
	public function testGetPages()
	{
		$sitemap_pages = new SitemapPages( 'https://www.google.com/sitemap.xml' );
		$this->assertContains( 'https://www.google.com/services/sitemap.xml', $sitemap_pages->getPageList() );
	}
}
