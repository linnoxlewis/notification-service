# notification-service
send notification for sms, push-notification and email

install :

          1. enter the command on console - composer require "linnoxlewis/notification-service"
          
          2. add command in your composer - 
          
          "require": {
          ...,
          "linnoxlewis/notification-service" : "dev-master",
          ...
          },
          
usage : 

          1. For sending push notification your application must registered in firebase cloud message and have api key.
          $service = new FcmService($apiKey,$title,$body,[$deviceToken1, $deviceToken2,...]);
          $service->send();
        
          2. For sending sms notification your application must registered in sms.ru service and have api key.
          $service = new FcmService($apiKey,$title,$body,[$telephoneNumber1, $telephoneNumber2,...]);
          $service->send();
        
          3. For sending mail notification 
          $service = new EmailService("",$title,$body,[$email1, $email2,...]);
          $service->send();
        
  
