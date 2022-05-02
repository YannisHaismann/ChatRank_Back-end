<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class JWTSubscriber implements EventSubscriberInterface
{
    public function onLexikJwtAuthenticationOnJwtCreated($event)
    {
       $data = $event->getData();
       $data['username'] = $event->getUser()->getUsername();
       $data['roles'] = $event->getUser()->getRoles();
       $data['email'] = $event->getUser()->getEmail();
       $event->setData($data);
    }

    public static function getSubscribedEvents()
    {
        return [
            'lexik_jwt_authentication.on_jwt_created' => 'onLexikJwtAuthenticationOnJwtCreated',
        ];
    }
}
