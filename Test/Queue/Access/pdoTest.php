<?php

//namespace phpMQ;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-03-30 at 14:29:47.
 */
class pdomTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var pdo
     */
    private $m;

    private $dsn      = 'mysql:host=127.0.0.1;dbname=phpmq_test';
    private $username = 'travis';
    private $password = '';
    private $options_pdo = [];

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
      
        $this->m= new \phpMQ\pdom($this->dsn, $this->username, $this->password, $this->options_pdo);
        getConnection();
        return $this->m;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers phpMQ\pdo::__destruct
     * @todo   Implement test__destruct().
     */
    public function test__destruct() 
    {
        $this->m->__destruct();
    }
    
    /**
     * Test name of the this class 
     */
    public function test_classname()
    {
        $this->assertInstanceOf('phpMQ\pdom', $this->m);
    }
    /**
     * Test function getType 
     */  
    public function test_getType()
    {
        $this->assertEquals($this->m->getType(), null);
    }
    
    /**
     * Test function getConfig 
     */ 
    public function test_getConfig()
    {
        $config['dsn'] = $this->dsn;
        $config['username'] = $this->username;
        $config['password'] = $this->password;
        $config['options']  = $this->options_pdo;
        $this->assertEquals($this->m->getConfig(), $config);
    }
    
    /**
     * Test function isServer 
     */ 
    public function test_isServer()
    {
        $this->assertEquals($this->m->isServer(), TRUE);
    }
    
    /**
     * Test function isClient 
     */
    public function test_isClient()
    {
        $this->assertEquals($this->m->isClient(), TRUE);
    }
    
    /**
     * Test constants values 
     */
    public function test_const()
    {
        $this->assertEquals(PHPMQ_SERVER, 1);
        $this->assertEquals(PHPMQ_CLIENT, 2);  
    }
    
    /**
     * Test values of protected vars
     */
    public function test_protected_vars()
    {
        $allowedTypes = array( 'message', 'api', 'fork', 'intval', 'dataval' );
        $allowedStatus = array( 'new', 'open', 'done', 'closed', 'failed' );
        $mode = TRUE;
        $type   = null;  
        $config = array();
        $this->assertAttributeEquals( $allowedTypes, 'allowedTypes', $this->m );
        $this->assertAttributeEquals( $allowedStatus, 'allowedStatus', $this->m );
        $this->assertAttributeEquals($mode, 'mode', $this->m);
        $this->assertAttributeEquals($type, 'type', $this->m);
    }
    
     /**
     * Test private function mergeOptions
     */   
    public function test_mergeOptions()
    {
        $options_queue = array('mq_type' =>'message', 'mq_timeout' => 3000,  'mq_intval' => 0, 'mq_maxerrors' => 1);
        
        $default_q= array( 'mq_name'      => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) ),
                          'mq_type'      => array( 'default' => 'message',
                                                   'values'  => array( 'message', 'api', 'fork', 'intval', 'dataval' ),
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) ),
                          'mq_timeout'   => array( 'default' => 3000,
                                                   'filter'  => array( 'filter'  => FILTER_VALIDATE_INT,
                                                                       'options' => array('min_range' => 1000, 'max_range' => 30000 ) ), ),
                          'mq_maxerrors' => array( 'default' => 1,
                                                   'filter'  => array( 'filter' => FILTER_VALIDATE_INT,
                                                                       'options' => array('min_range' => 1, 'max_range' => 10 ), ), ),
                          'mq_desc'      => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) ),
                          'mq_respond'   => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_URL ), ),
                          'mq_intval'    => array( 'default' => 0,
                                                   'filter'  => array( 'filter' => FILTER_VALIDATE_INT ), ),
                          'mq_data'      => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) )
);
        
        $method = new ReflectionMethod( 'phpMQ\pdom', 'mergeOptions');
        $method->setAccessible(TRUE);        
        $this->assertEquals(
        $options_queue, $method->invoke($this->setUp(), 
        $default_q, $options_queue)
        );
        $default_m= array( 'mq_id'        => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_VALIDATE_INT ) ),
                          'm_msg'        => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_SPECIAL_CHARS ) ),
                          'm_log'        => array( 'default' => null,
                                                   'filter'  => array( 'filter'  => FILTER_SANITIZE_STRING ) ),
                          'm_respond'    => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_URL ) ),
                          'm_status'     => array( 'default' => 'new',
						   'values'  => array( 'new', 'open', 'done', 'closed', 'failed' ),
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) ),
                          'm_started'    => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) ),
                          'm_reply'      => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) ),
                          'm_rc'         => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_VALIDATE_INT ) ),
                          'm_completed'  => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) ),
			  'm_errors'     => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_VALIDATE_INT ) ),
                          'm_uuid'       => array( 'default' => null,
                                                   'filter'  => array( 'filter' => FILTER_SANITIZE_STRING ) )
                        );
        $options_m = array('m_status' =>'new', 'm_msg' => 'test merge');
        $this->assertEquals(
        $options_m, $method->invoke($this->setUp(), 
        $default_m, $options_m)
        );
        
    }
    
     /**
     * Test private function addQueueProc
     * Return integer mq_id of new queue
     */      
    public function test_addQueueProc()
    {
        
        $method = new ReflectionMethod( 'phpMQ\pdom', 'addQueueProc');
        $method->setAccessible(TRUE); 
        $name = $this->options_queue['mq_name'] = 'Hello from addQueueProc';
        $this->assertInternalType(
        'integer', $method->invoke($this->setUp(), 
        $this->options_queue)
        );
        return $name;
    }
    
    /**
     * @depends test_addQueueProc
     * Test private function getQueueInfo
     * Return must have array with parameters of queue
     */ 
    public function test_getQueueInfo($name)
    {
        $method = new ReflectionMethod( 'phpMQ\pdom', 'getQueueInfo');
        $method->setAccessible(TRUE); 
        $this->assertInternalType('array',
        $method->invoke($this->setUp(), 
        $name)
        );
    }
    
    /**
     * @depends test_addQueueProc
     * Test private function getQueueID
     * Return integer mq_id of queue
     */ 
    public function test_getQueueID($name)
    {    
        $method = new ReflectionMethod( 'phpMQ\pdom', 'getQueueID');
        $method->setAccessible(TRUE); 
        $mid = $method->invoke($this->setUp(), 
        $name);
        $this->assertInternalType('integer', $mid );
        return $mid;
    }
    
    /**
     * @depends test_getQueueID
     * Test private function setQueueInfo()
     * Return result (TRUE/FALSE) of changing queue info  
     */
    public function test_setQueueInfo($mid)
    {    
        $options_set = [];
        $options_set['mq_desc'] = 'Hello from setQueueInfo';
        $method = new ReflectionMethod( 'phpMQ\pdom', 'setQueueInfo');
        $method->setAccessible(TRUE); 
        $this->assertEquals (TRUE ,
        $method->invoke($this->setUp(), 
        intval($mid), $options_set )
        );
    }
    
    /**
     * Test private function addQueue()
     * Return integer mq_id or error if queue with the same name already exists
     */
    public function test_addQueue_1()
    {    
        $name = 'Hello from addQueue';
        $this->assertInternalType('integer', $this->m->addQueue(  $name ) );
        return $name;
    }
    
    /**
     * @expectedException phpMQ\Exception\phpMQException
     */
    public function test_addQueue_2()
    {    
        $name = 'Hello from addQueue';
        $this->m->addQueue(  $name );
    }
    
    /**
     * @expectedException phpMQ\Exception\phpMQException
     */    
    public function test_addQueue_3()
    {    
        $name = NULL;
        $this->m->addQueue(  $name );
    }
    
    /**
     * Test private function addMessageProc()
     */
    public function test_addMessageProc()
    {    
        $message =[]; 
        $message['mq_id'] = 1;
        $message['m_msg'] = "hello from addMessageProc";
        $method = new ReflectionMethod( 'phpMQ\pdom', 'addMessageProc');
        $method->setAccessible(TRUE); 
        $mid = $method->invoke($this->setUp(), $message);
        $this->assertInternalType('integer',  $mid );
    }
    
    /**
    * Return params if queue $name exist $mid integer else FALSE 
    */
    public function test_addMessage_1()
    {    
        $name = 'Hello from addMessage 1';
        $this->m->addQueue($name);
        $message = array('param1' =>'Hello from addMessage 1', 'param2' => 3000,  'param3' => 0, 'param4' => 1); 
        $options_message =array('m_status' =>'new', 'm_log' => 'test addMessage 1');
        $this->assertInternalType('integer', $this->m->addMessage( $name, $message) );
    }
    
    /**
     * @expectedException phpMQ\Exception\phpMQException
     */    
    public function test_addMessage_2()
    {
        $name = NULL;
        $message = 'Hello from addMessage 2'; 
        $mid = $this->m->addMessage( $name, $message );
    }
    
    /**
     * @expectedException phpMQ\Exception\phpMQException
     */      
    public function test_addMessage_3()
    {
        $name = 'Hello from addMessage 3';
        $this->m->addQueue($name);
        $message = FALSE; 
        $this->m->addMessage(  $name, $message  );
    }
    /**
     * @expectedException phpMQ\Exception\phpMQException
     */      
    public function test_addMessage_4()
    {
        $name = 'Hello from addMessage 4';
        $this->m->addQueue($name);
        $message = NULL;
        $this->m->addMessage( $name, $message  );
    }
    
    /**
     * Test private function consumeMessageProc()
     */     
    public function test_consumeMessageProc()
    {    
        $name ='Hello from consumeMessageProc';
        $this->m->addQueue($name);
        $method = new ReflectionMethod( 'phpMQ\pdom', 'consumeMessageProc');
        $method->setAccessible(TRUE); 
        $this->assertEquals(FALSE,
        $method->invoke($this->setUp(), 
        $name)
        );
    }
    
    /**
     * Test private function_removeMessageProc()
     */     
    public function test_removeMessageProc()
    {    
        $name = 'Hello from removeMessageProc';
        $this->m->addQueue($name);
        $mid = $this->m->addMessage( $name, $name );
        $method = new ReflectionMethod( 'phpMQ\pdom', 'removeMessageProc');
        $method->setAccessible(TRUE); 
        $this->assertEquals(TRUE,
        $method->invoke($this->setUp(), 
        $mid)
        );
    }
    
    /**
     * Test add queue and message, check consume empty and non-empty queue  
     */
    public function test_consumeMessage()
    {
        $name = 'Hello from consumeMessage';
        $this->m->addQueue($name);
        $message = array('param1' =>'Hello from consumeMessage 1', 'param2' => 3000,  'param3' => 0, 'param4' => 1); 
        $message_json = json_encode($message);
        $this->m->addMessage($name, $message);
        $message_consume = $this->m->consumeMessage(  $name );
        $this->assertEquals($message_json, $message_consume['m_msg'] );
        
        $message_consume2 = $this->m->consumeMessage(  $name );
        $this->assertFalse($message_consume2);
    }
    
    /**
     * @expectedException phpMQ\Exception\phpMQException
     */     
    public function test_consumeMessage_2()
    {
        $name = 'Hello from consumeMessage 2';
        $message = $this->m->consumeMessage(  $name  );
    }
    
    /**
     * Add queue and 2 messages, check correctness of consumeMessage
     */    
    public function test_consumeMessage_3()
    {
        $name = 'Hello from consumeMessage 3';
        $this->m->addQueue( $name );
        $this->m->addMessage( $name, $name );
        $this->m->addMessage( $name, $name );        
        $message_consume_1 = $this->m->consumeMessage( $name );
        $this->assertEquals($name, $message_consume_1['m_msg'] );
        
        $message_consume_2 = $this->m->consumeMessage( $name );
        $this->assertNotEquals($message_consume_1, $message_consume_2 );
    }
    
    /**
     * Add queue and 2 messages in it, check the order in the queue
     */
    public function test_consumeMessage_4()
    {
        $name = 'Hello from consumeMessage 4';
        $this->m->addQueue( $name );
        $this->m->addMessage( $name, $name );
        $this->m->addMessage( $name, $name );        
        $message_consume_1 = $this->m->consumeMessage( $name );     
        $message_consume_2 = $this->m->consumeMessage( $name );
        $this->assertLessThan( $message_consume_2['m_id'], $message_consume_1['m_id'] );
    }
       
    /**
     * Add queue and message in it, check removing message from non-empty and empty queue
     */    
    public function test_removeMessage()
    {     
        $name = 'Hello from removeMessage ';
        $this->m->addQueue(  $name  );
        $mid = $this->m->addMessage(  $name, $name  );        
        $this->assertTrue( $this->m->removeMessage(  $mid  ) );
        
        $this->assertFalse( $this->m->removeMessage(  $mid  ) );
    }

    /**
     * @expectedException phpMQ\Exception\phpMQException
     */
    public function test_removeQueue_1()
    {     
        $name = 'Hello from removeQueue 1';
        $purge = FALSE;
        $this->m->addQueue(  $name  );
        $this->m->addMessage($name, $name);
        $this->m->removeQueue(  $name, $purge  );
    }
    
    /**
     * @expectedException phpMQ\Exception\phpMQException
     */
    public function test_removeQueue_2()
    {     
        $name = 'Hello from removeQueue 2';
        $this->m->removeQueue(  $name , FALSE );
    }
    
    public function test_removeQueue_3()
    {     
        $name = 'Hello from removeQueue 3';
        $this->m->addQueue(  $name );
        $this->m->removeQueue(  $name , TRUE );
    }
    
    /**
     * Add queue, add message in queue, remove queue, check queue and message 
     */
    public function test_removeQueue_4()
    {     
        $name = 'Hello from removeQueue 4';
        $purge = TRUE;
        $this->m->addQueue(  $name  );
        $mid = $this->m->addMessage($name, $name, array());
        $this->m->removeQueue(  $name, $purge  );
        $method = new ReflectionMethod( 'phpMQ\pdom', 'getQueueID');
        $method->setAccessible(TRUE); 
        $this->assertFalse( $method->invoke($this->setUp(), 
        $name)  );
        
        $this->assertFalse( $this->m->removeMessage(  $mid  ));
        
    }
    
    public function test_removeQueueProc()
    {    
        $name = 'Hello from removeQueueProc';
        $mid = $this->m->addQueue($name);
        $method = new ReflectionMethod( 'phpMQ\pdom', 'removeQueueProc');
        $method->setAccessible(TRUE); 
        $this->assertEquals(TRUE,
        $method->invoke($this->setUp(), 
        $mid) );
    }   
    
    public function test_getMessageIDfromQueue_1()
    {
        $name='getMessageIDfromQueue 1';
        $mq_id = $this->m->addQueue($name);
        $mid[] = $this->m->addMessage ( $name, 'Hello from getMessageIDfromQueue' );
        $mid[] = $this->m->addMessage ( $name, 'Hello from getMessageIDfromQueue' );
        $mid[] = $this->m->addMessage ( $name, 'Hello from getMessageIDfromQueue' );
        $method = new ReflectionMethod( 'phpMQ\pdom', 'getMessageIDfromQueue');
        $method->setAccessible(TRUE); 
        $mid_get = $method->invoke($this->setUp(), $mq_id);
        $this->assertEquals($mid, $mid_get);
    }
    
    public function test_getMessageIDfromQueue_2()
    {
        $name='getMessageIDfromQueue 2';
        $mq_id = $this->m->addQueue($name);
        $method = new ReflectionMethod( 'phpMQ\pdom', 'getMessageIDfromQueue');
        $method->setAccessible(TRUE); 
        $mid_get = $method->invoke($this->setUp(), $mq_id);
        $this->assertEquals(FALSE, $mid_get);
    }
        
}
