<?php

namespace DrupalRector\Rector\ValueObject;

class AssertLegacyTraitConfiguration
{

    private string $deprecatedMethodName;
    private string $methodName;
    private string $comment;
    private bool $isAssertSessionMethod;
    private bool $processFirstArgumentOnly;
    private string $declaringSource;
    private ?string $prependArgument;

    /**
     * @param string $deprecatedMethodName Deprecated method name.
     * @param string $methodName Method to call instead.
     * @param string $comment Comment to add to the method call.
     * @param bool $isAssertSessionMethod Whether the new method is an assertSession method.
     * @param bool $processFirstArgumentOnly Toggle to reduce the number of arguments passed to 1.
     * @param string $declaringSource The class that declares the deprecated method.
     */
    public function __construct(string $deprecatedMethodName, string $methodName, string $comment = '', bool $isAssertSessionMethod = true, bool $processFirstArgumentOnly = false, string $declaringSource = 'Drupal\FunctionalTests\AssertLegacyTrait', ?string $prependArgument = null)
    {
        $this->deprecatedMethodName = $deprecatedMethodName;
        $this->methodName = $methodName;
        $this->comment = $comment;
        $this->isAssertSessionMethod = $isAssertSessionMethod;
        $this->processFirstArgumentOnly = $processFirstArgumentOnly;
        $this->declaringSource = $declaringSource;
        $this->prependArgument = $prependArgument;
    }

    public function getDeprecatedMethodName(): string
    {
        return $this->deprecatedMethodName;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function isAssertSessionMethod(): bool
    {
        return $this->isAssertSessionMethod;
    }

    public function isProcessFirstArgumentOnly(): bool
    {
        return $this->processFirstArgumentOnly;
    }

    public function getDeclaringSource(): string
    {
        return $this->declaringSource;
    }

    public function getPrependArgument(): ?string
    {
        return $this->prependArgument;
    }

}
