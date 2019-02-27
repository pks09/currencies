<?php

namespace console\components\import;

/**
 * UnexpectedXmlException исключение, возникающее при получении из источника данных xml с неожиданной структурой
 */
class UnexpectedXmlException extends \LogicException
{
    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        return 'Unexpected xml structure';
    }
}