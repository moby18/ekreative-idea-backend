<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
    }

    public function testLogout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/logout');
    }

    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');
    }

    public function testIdealist()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ideaList');
    }

    public function testIdeaitem()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ideaItem');
    }

    public function testIdeasubmit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ideaSubmit');
    }

    public function testIdeacommentlist()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ideaCommentList');
    }

    public function testIdealike()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ideaLike');
    }

    public function testIdeadislike()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ideaDislike');
    }

}
