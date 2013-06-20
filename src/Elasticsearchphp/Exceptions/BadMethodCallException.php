<?php

namespace Elasticsearchphp\Exceptions;

/**
 * BadMethodCallException - used to denote problems with a method call (wrong or otherwise incorrect arguments)
 */
class BadMethodCallException extends \BadMethodCallException implements ElasticsearchphpException {}