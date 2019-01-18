<?php

use PHPUnit\Framework\TestCase;
use WaughJ\SitemapPages\SitemapPages;

class SitemapPagesTest extends TestCase
{
	public function testPage()
	{
		$sitemap_pages = new SitemapPages( 'https://www.ascendprime.com' );
		$this->assertContains( '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="//www.ascendprime.com/wp-content/plugins/wordpress-seo/css/main-sitemap.xsl"?>', $sitemap_pages->getText() );
	}

	/*
	public function testGetPages()
	{
		$sitemap_pages = new SitemapPages( 'https://www.ascendprime.com' );
		$this->assertContains( 'https://www.ascendprime.com/2018/07/30/ascend-prime-ribbon-cutting/', $sitemap_pages->getPageList() );
	}*/
}
