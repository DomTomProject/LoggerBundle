# LoggerBundle
Bundle for fast loggin and static storage

## 1. Installation
```
 composer require domtomproject/logger-bundle
```
AND in AppKernel.php
```
$bundles = [
...
  new DomTomProject\LoggerBundle\DomtomLoggerBundle(),
...
];
```

## 2. Configuration
In this example we use MysqlWriter.
In config.yml
```
...
doctrine:
    dbal:
        default_connection: default
        connections:
            ...
            log:
                driver:   pdo_mysql
                host:     '%database_host%'
                port:     '%database_port%'
                dbname:   'database'
                user:     '%database_user%'
                password: '%database_password%'
                charset:  UTF8
...
orm:
   ...
   entity_managers:
     log:
        connection: log
        mappings:
            AppBundle: ~
...
domtom_logger:
    writer: "domtom_logger.writer_mysql"
    mysql:
        manager: log
```
So now manager for logs is 'log'. Thats provide you to use other database for log data.

## 3. Using Example
#### a) Create new Log Entity.
```
use Doctrine\ORM\Mapping as ORM;
use DomTomProject\LoggerBundle\Model\Log;

/**
 * @ORM\Entity
 */
class CustomLog extends Log {

    /**
     * @Column(type="text", nullable=true)
     */
    protected $text;

    public function __construct() {
        parent::__construct();
    }
    
    // method for short creating in one line 
    public static function create(?string $text = null){
       $log = new self();
       $log->setText($text);
       return $log;
    }
    
    // setters and getters ...

}

```
#### b) Now in controller action
```
   public function testLogAction(){
      $logStack = $this->get('domtom_logger.log_stack');
      $logStack->add(CustomLog::create('Log that'));
      ....
      
      // if something failed you can check all logs in stack as failed. Its done automatically if kernel.exception event is called.
      if($somethingBroken){
         $logStack->failed();
      }
      
   }
```
#### c) Logs will be automatically saved on kernel.terminate event.


