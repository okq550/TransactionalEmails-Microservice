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
     * test register send email api.
     *
     * @return void
     */
    public function testTheRegisterAPI()
    {
        $requestPayLoad = array("reciepents" => array( 
                ['first_name' => 'Osamah', 'last_name' => 'Qawasmeh', 'email' => 'okq550@gmail.com', 'format' => 'text']
            )
        );

        $this->json('POST', '/register', $requestPayLoad)
             ->seeJsonEquals([
                'success' => true
             ]);

        $this->assertEquals(200, $this->response->status());
    }

    /**
     * test forget password send email api.
     *
     * @return void
     */
    public function testTheForgetPasswordAPI()
    {
        $requestPayLoad = array("reciepents" => array(
                ['first_name' => 'Osamah', 'last_name' => 'Qawasmeh', 'email' => 'okq550@gmail.com', 'format' => 'html'] 
            )
        );

        $this->json('POST', '/forgetPassword', $requestPayLoad)
             ->seeJsonEquals([
                'success' => true,
             ]);

        $this->assertEquals(200, $this->response->status());
    }
}
