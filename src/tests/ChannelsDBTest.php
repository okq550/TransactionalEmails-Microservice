<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
    /**
     * Test if channels are inserted in DB.
     *
     * @return void
     */
    public function testChannelsDBData()
    {
        $this->seeInDatabase('channels', ['name' => 'MailJet']);
        $this->seeInDatabase('channels', ['name' => 'MailGun']);
        $this->seeInDatabase('channels', ['name' => 'SendGrid']);
    }
}
