<?php
    require_once 'dbconnection.php';
    class SessionManager{
        // name of the collection where sessions will be stored
        const COLLECTION = 'sessions';
        // Expire session after 10min of inactivity
        const SESSION_TIMEOUT = 600;
        // Expire session after 1 hour
        const SESSION_LIFESPAN = 3600;
        // name of the session cookie
        const SESSION_NAME = 'mongosessid';
        const SESSION_COOKIE_PATH = '/';
        // Should be the domain name of your web app, for example
        // mywebapp.com. DO NOT use empty string unless you are
        // running on a local environment.
        const SESSION_COOKIE_DOMAIN = '';

        private $_mongo;
        private $_collection;

        // Represents the current session
        private $_currentSession;

        public function __construct(){
            $this->_mongo = DBConnection::instantiate();
            $this->_collection = $this->_mongo->getCollection(SessionManager::COLLECTION);

            session_set_save_handler(
                [&$this, 'open'],
                [&$this, 'close'],
                [&$this, 'read'],
                [&$this, 'write'],
                [&$this, 'destroy'],
                [&$this, 'gc']
            );

            // Set session garbage collection period
            ini_set('session.gc_maxlifetime', SessionManager::SESSION_LIFESPAN);

            // Set session cookie configurations
            session_set_cookie_params(
                SessionManager::SESSION_LIFESPAN,
                SessionManager::SESSION_COOKIE_PATH,
                SessionManager::SESSION_COOKIE_DOMAIN
            );

            // Replace 'PHPSESSID with 'mongosessid' as the session name
            session_name(SessionManager::SESSION_NAME);

            session_cache_limiter('nocache');

            // start the session
            session_start();
         }

         public function open($path, $name){
             return true;
         }

         public function close(){
             return true;
         }

         public function read($sessionId){
             $query = [
                 'session_id' => $sessionId,
                 'timedout_at' => ['$gte' => time()],
                 'expired_at' =>['$gte' => time() - SessionManager::SESSION_LIFESPAN]
             ];
             $result = $this->_collection->findOne($query);
             $this->_currentSession = $result;
             if(!isset($result['data'])){
                 return '';
             }
             return $result['data'];
         }

         public function write($sessionId, $data){
             $expired_at = time() + self::SESSION_TIMEOUT;
             $new_obj = [
                 'data' => $data,
                 'timedout_at' => time() + self::SESSION_TIMEOUT,
                 'expired_at' => (empty($this->_currentSession)) ? 
                 time() + SessionManager::SESSION_LIFESPAN : 
                 $this->_currentSession['expired_at']
             ];
             $query = ['session_id' => $sessionId];
             $this->_collection->updateOne(
                 $query,
                 ['$set' => $new_obj],
                 ['upsert' => TRUE]
             );
             return TRUE;
         }

         public function destroy($sessionId){
             $this->_collection->delete(
                 ['session_id' => $sessionId]
             );
             return TRUE;
         }

         public function gc(){
             $query = ['expired_at' => ['$lt' => time()]];
             $this->_collection->delete($query);
             return TRUE;
         }

         public function __destruct(){
             session_write_close();
         }
    }

    // initiate the session
    $session = new SessionManager();