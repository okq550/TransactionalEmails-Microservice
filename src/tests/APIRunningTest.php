<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class APIRunningTest extends TestCase
{
    /**
     * test if the API is running.
     *
     * @return void
     */
    public function testTheAPIIsRunning()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );

        $this->assertEquals(200, $this->response->status());
    }

    /**
     * test if the API is running.
     *
     * @return void
     */
    public function testTheRegisterAPI()
    {
        $this->json('POST', '/register', ['first_name' => 'Osamah', 'last_name' => 'Qawasmeh', 'email' => 'okq550@gmail.com', 'format' => 'html'])
             ->seeJson([
                'success' => true,
             ]);

        $this->assertEquals(200, $this->response->status());
    }

    /**
     * test if the API is running.
     *
     * @return void
     */
    public function testTheForgetPasswordAPI()
    {
        $this->json('POST', '/forgetPassword', ['first_name' => 'Osama', 'last_name' => 'Khd', 'email' => 'okq550@yahoo.com', 'format' => 'text'])
             ->seeJsonEquals([
                'success' => true,
             ]);

        $this->assertEquals(200, $this->response->status());
    }
}
