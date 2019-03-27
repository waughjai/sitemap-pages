<?php

use PHPUnit\Framework\TestCase;
use WaughJ\SitemapPages\SitemapPages;

class SitemapPagesTest extends TestCase
{
	public function testGetPages()
	{
		$sitemap_pages = new SitemapPages( 'https://www.smashingmagazine.com/sitemap.xml' );
		$this->assertContains( '/author/zach-dunn/', $sitemap_pages->getPageList() );
	}

	public function testGetPagesRecursive()
	{
		$sitemap_pages = new SitemapPages( 'ascendprime.com/sitemap.xml' );
		$this->assertContains( 'https://ascendprime.com/vip-email-newsletter/', $sitemap_pages->getPageList() );
	}
}
