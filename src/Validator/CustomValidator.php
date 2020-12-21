<?php

namespace App\Validator;


use App\Entity\Customer;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class CustomValidator
{
    public static function validate(Customer $customEntity, ExecutionContextInterface $context, $payload)
    {
          //Do condition with your entity attributes
           $message = 'Test error validation';

           $context->buildViolation($message)
                ->addViolation()
           ;
    }
}

